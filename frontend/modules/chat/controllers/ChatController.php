<?php
namespace frontend\modules\chat\controllers;

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
        return $this->render('dialog');
    }
}