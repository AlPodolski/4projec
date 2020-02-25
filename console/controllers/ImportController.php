<?php


namespace console\controllers;

use yii\console\Controller;
use dastanaron\translit\Translit;
use common\models\Smoking as Model;

class ImportController extends Controller
{
    public function actionIndex()
    {

        $translit = new Translit();

        $params = ['не курю', 'курю', 'курю редко', 'бросаю'];

        foreach ($params as $param){

            $model = new Model();

            $model->value = $param;
            $model->url = \strtolower($translit->translit($param, true, 'ru-en'));

            $model->save();

        }

    }
}