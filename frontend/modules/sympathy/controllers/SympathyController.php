<?php


namespace frontend\modules\sympathy\controllers;

use yii\web\Controller;


class SympathyController extends Controller
{
    public function behaviors()
    {
        return [
            \common\behaviors\isAuth::class,
        ];
    }

    public function actionIndex($city)
    {
        return $this->render('index');
    }
}