<?php


namespace frontend\controllers;

use yii\web\Controller;
use Yii;

class InvitationController extends Controller
{
    public function actionClose()
    {
        return Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'invitation-message',
            'value' => 'close',
        ]));
    }

    public function actionSetData()
    {

        if (Yii::$app->request->isPost){

            $profile_id = Yii::$app->request->post('profile_id');
            $message = Yii::$app->request->post('message');
            $inv_message = Yii::$app->request->post('inv_message');

            return Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'chat_info',
                'value' => \json_encode(array([
                    'profile_id' => $profile_id,
                    'message' => $message,
                    'inv_message' => $inv_message,
                ])),
            ]));

        }

    }
}