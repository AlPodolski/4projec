<?php
namespace frontend\modules\chat\controllers;

use yii\web\Controller;

class ChatController extends Controller
{
    public function actionIndex()
    {
        return $this->render('list');
    }
}