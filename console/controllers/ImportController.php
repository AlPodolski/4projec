<?php


namespace console\controllers;

use yii\console\Controller;
use dastanaron\translit\Translit;
use common\models\Vneshnost;

class ImportController extends Controller
{
    public function actionIndex()
    {

        $translit = new Translit();

        $params = ['великолепна', 'вполне привлекательна', 'обыкновенная', 'себе не нравлюсь', 'не мне судить'];

        foreach ($params as $param){

            $model = new Vneshnost();

            $model->value = $param;
            $model->url = $translit->translit($param, true, 'ru-en');

            $model->save();

        }

    }
}