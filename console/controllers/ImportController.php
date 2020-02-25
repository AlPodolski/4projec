<?php


namespace console\controllers;

use yii\console\Controller;
use dastanaron\translit\Translit;
use common\models\Interesting;

class ImportController extends Controller
{
    public function actionIndex()
    {

        $translit = new Translit();



        foreach ($params as $param){

            $interesting = new Interesting();

            $interesting->value = $param;
            $interesting->url = $translit->translit($param, true, 'ru-en');

            //$interesting->save();

        }

    }
}