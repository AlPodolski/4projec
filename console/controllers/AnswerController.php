<?php


namespace console\controllers;

use yii\console\Controller;
use common\models\BlackList;

class AnswerController extends Controller
{
    public function actionIndex()
    {
        $blackList = BlackList::find()->asArray()->all();

        foreach ($blackList as $blackListItem){

            \d($blackListItem);

        }

    }


}