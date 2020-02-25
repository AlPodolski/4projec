<?php


namespace console\controllers;

use yii\console\Controller;
use dastanaron\translit\Translit;
use common\models\Alcogol as Model;

class ImportController extends Controller
{
    public function actionIndex()
    {

        $translit = new Translit();

        $params = ['не пью вообще', 'пью в компаниях изредка', 'люблю выпить'];

        foreach ($params as $param){

            $model = new Model();

            $model->value = $param;
            $model->url = \strtolower($translit->translit($param, true, 'ru-en'));

            $model->save();

        }

    }
}