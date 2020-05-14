<?php


namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class CashController extends Controller
{
    public function actionPay()
    {
        \dd(Yii::$app->request->post());
    }
}