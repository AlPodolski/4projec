<?php
namespace frontend\modules\chat\controllers;

use frontend\modules\chat\models\forms\SendMessageForm;
use frontend\modules\chat\models\relation\UserDialog;
use frontend\modules\user\models\Profile;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

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

        if (Yii::$app->request->isPost and (Yii::$app->user->id != Yii::$app->request->post('id'))){

            $user = Profile::find()->where(['id' => Yii::$app->user->id])->with('userAvatarRelations')->asArray()->one();

            $userTo = Profile::find()->where(['id' => Yii::$app->request->post('id')])->with('userAvatarRelations')->asArray()->one();

            $userDialogsId = ArrayHelper::getColumn(UserDialog::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all(), 'dialog_id');

            $dialog_id = UserDialog::find()->where(['user_id' => Yii::$app->request->post('id')])->andWhere(['in', 'dialog_id',$userDialogsId ])->asArray()->one();

            if ($dialog_id) $dialog_id = ArrayHelper::getValue($dialog_id, 'dialog_id');

            return $this->renderFile(Yii::getAlias('@app/modules/chat/views/chat/get-dialog.php'), [
                'dialog_id' => $dialog_id,
                'user' => $user,
                'userTo' => $userTo,
                'recepient' => Yii::$app->request->post('id'),
            ]);

        }

        return false;

    }

    public function actionSend($city)
    {

        if (Yii::$app->request->isPost and !Yii::$app->user->isGuest){

            $model = new SendMessageForm();

            $model->from_id = Yii::$app->user->id;
            $model->created_at = \time();

            if ($model->load(Yii::$app->request->post()) and $model->validate() ){

                $model->save();

            }

        }
    }
}