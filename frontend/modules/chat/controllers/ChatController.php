<?php
namespace frontend\modules\chat\controllers;

use frontend\components\helpers\VipHelper;
use frontend\modules\chat\models\forms\SendMessageForm;
use frontend\modules\chat\models\relation\UserDialog;
use frontend\modules\user\models\Profile;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use frontend\components\helpers\CheckVipDialogHelper;

class ChatController extends Controller
{

    public function behaviors()
    {
        return [
            \common\behaviors\isAuth::class,
        ];
    }

    public function actionIndex($city)
    {

        return $this->render('list' , [
            'user_id' => Yii::$app->user->id,
        ]);
    }

    public function actionChat($city, $id)
    {

        $usersInDialog = ArrayHelper::getColumn(UserDialog::find()->where(['dialog_id' => $id])
            ->select('user_id')
            ->asArray()->all(), 'user_id');

        if(!\in_array(Yii::$app->user->id, $usersInDialog )) return $this->goHome();

        $user = Profile::find()->where(['id' => Yii::$app->user->id])->with('userAvatarRelations')->asArray()->one();

        $recepient_id = UserDialog::find()->where(['dialog_id' => $id])
            ->andWhere(['<>', 'user_id', Yii::$app->user->id ])
            ->select('user_id')
            ->asArray()->one();

        $userTo = Profile::find()->where(['id' => $recepient_id['user_id']])->with('userAvatarRelations')->asArray()->one();

        return $this->render('dialog', [
            'dialog_id' => $id,
            'user' => $user,
            'userTo' => $userTo,
        ]);
    }

    public function actionGet($city)
    {

        $dialog_id = 0;
        $limitExist = false;

        if (Yii::$app->request->isPost and (Yii::$app->user->id != Yii::$app->request->post('id'))){

            $userDialogsId = ArrayHelper::getColumn(UserDialog::find()
                ->where(['user_id' => Yii::$app->user->id])->asArray()->all(), 'dialog_id');

            $dialog_id = UserDialog::find()->where(['user_id' => Yii::$app->request->post('id')])
                ->andWhere(['in', 'dialog_id',$userDialogsId ])->asArray()->one();

            if (!VipHelper::checkVip(Yii::$app->user->identity['vip_status_work'])){

                if (isset($dialog_id['id'])){

                    if (!CheckVipDialogHelper::checkLimitDialog(Yii::$app->user->id , Yii::$app->params['dialog_day_limit'])) {
                        $limitExist = true;
                    }

                }else{

                    if (!CheckVipDialogHelper::checkExistDialogId(Yii::$app->user->id , $dialog_id['id']) and
                        !CheckVipDialogHelper::checkLimitDialog(Yii::$app->user->id , Yii::$app->params['dialog_day_limit'])
                    ) $limitExist = true;

                }

            }

            if ($dialog_id) $dialog_id = ArrayHelper::getValue($dialog_id, 'dialog_id');

            $user = Profile::find()->where(['id' => Yii::$app->user->id])
                ->with('userAvatarRelations')->asArray()->one();

            $userTo = Profile::find()->where(['id' => Yii::$app->request->post('id')])
                ->with('userAvatarRelations')->asArray()->one();

            return $this->renderFile(Yii::getAlias('@app/modules/chat/views/chat/get-dialog.php'), [
                'dialog_id' => $dialog_id,
                'user' => $user,
                'userTo' => $userTo,
                'limitExist' => $limitExist,
                'recepient' => Yii::$app->request->post('id'),
            ]);

        }

        return false;

    }

    public function actionSend($city)
    {


        if (Yii::$app->request->isPost){

            $model = new SendMessageForm();

            $model->from_id = Yii::$app->user->id;
            $model->created_at = \time();

            $model->load(Yii::$app->request->post());

            if (!VipHelper::checkVip(Yii::$app->user->identity['vip_status_work'])){

                if ($model->chat_id == ''){

                    if (!CheckVipDialogHelper::checkLimitDialog(Yii::$app->user->id, Yii::$app->params['dialog_day_limit'])) return 'Превышен лимит диалогов';

                }else{

                    if (!CheckVipDialogHelper::checkExistDialogId(Yii::$app->user->id, $model->chat_id) and
                        !CheckVipDialogHelper::checkLimitDialog(Yii::$app->user->id, Yii::$app->params['dialog_day_limit'])
                    ) return 'Превышен лимит диалогов';

                }

            }

            if ( $model->validate() ){

                if ($dialog_id = $model->save() and !CheckVipDialogHelper::checkExistDialogId(Yii::$app->user->id, $dialog_id)){

                    CheckVipDialogHelper::addDialogIdToDay(Yii::$app->user->id, $dialog_id);

                }

            }

        }
    }
}