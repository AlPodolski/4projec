<?php


namespace frontend\modules\user\controllers;

use frontend\modules\user\components\behavior\LastVisitTimeUpdate;
use yii\web\Controller;

class AlbomController extends Controller
{

    public function behaviors()
    {
        return [
            \common\behaviors\isAuth::class,
            LastVisitTimeUpdate::class,
        ];
    }


    public function actionAdd()
    {



        return true;
    }
}