<?php


namespace frontend\modules\user\controllers;

use frontend\modules\user\models\News;
use Yii;
use yii\web\Controller;

class NewsController extends Controller
{
    public function actionList($city)
    {

        if (!Yii::$app->user->isGuest){

            return $this->render('list');

        }

        return $this->goHome();

    }
}