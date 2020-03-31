<?php
namespace frontend\modules\chat\controllers;

use frontend\modules\chat\models\forms\SendMessageForm;
use Yii;
use yii\web\Controller;

class ChatController extends Controller
{
    public function actionIndex($city)
    {

        return $this->render('list' , [
            'user_id' => Yii::$app->user->id,
        ]);
    }

    public function actionChat($city, $id)
    {
        return $this->render('dialog', [
            'dialog_id' => $id,
        ]);
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