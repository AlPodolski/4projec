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
}