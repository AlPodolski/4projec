<?php

namespace frontend\modules\user\controllers;

class UserController extends \yii\web\Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}
