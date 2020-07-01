<?php
namespace chat\modules\chat\controllers;

use chat\modules\chat\components\helpers\GetDialogsHelper;
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

        $fakeUsers = ArrayHelper::getColumn(Profile::find()->asArray()->where(['fake' => 0])->select('id')->asArray()->all(), 'id');

        $userFromDialog = UserDialog::find()->where(['dialog_id' => $id])->andWhere(['in', 'user_id', $fakeUsers])->select('user_id')->asArray()->one();

        $user = Profile::find()->where(['id' => ArrayHelper::getValue($userFromDialog, 'user_id')])->with('userAvatarRelations')->asArray()->one();

        return $this->render('dialog', [
            'dialog_id' => $id,
            'user' => $user,
            'fakeUsers' => $fakeUsers,
        ]);
    }

    public function actionGet($city)
    {

        if (Yii::$app->request->isPost ){

            $id = Yii::$app->request->post('dialog_id');

            $fakeUsers = ArrayHelper::getColumn(Profile::find()->asArray()->where(['fake' => 0])->select('id')->asArray()->all(), 'id');

            $userFromDialog = UserDialog::find()->where(['dialog_id' => $id])->andWhere(['in', 'user_id', $fakeUsers])->select('user_id')->asArray()->one();
            $user = Profile::find()->where(['id' => ArrayHelper::getValue($userFromDialog, 'user_id')])->with('userAvatarRelations')->asArray()->one();

            return $this->renderFile(Yii::getAlias('@app/modules/chat/views/chat/get-dialog.php'), [
                'dialog_id' => $id,
                'user' => $user,
                'recepient' => Yii::$app->request->post('id'),
            ]);

        }

        return false;

    }

    public function actionSend($city)
    {

        if (Yii::$app->request->isPost and !Yii::$app->user->isGuest){

            $model = new SendMessageForm();

            $model->created_at = \time();

            if ($model->load(Yii::$app->request->post()) and $model->validate() ){

                $model->save();

            }

        }
    }
}