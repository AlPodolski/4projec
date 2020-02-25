<?php


namespace console\controllers;

use yii\console\Controller;
use dastanaron\translit\Translit;
use common\models\WantFind as Model;

class ImportController extends Controller
{
    public function actionIndex()
    {

        $translit = new Translit();

        $params = ['Парня ', 'Девушку', 'Пару ', 'Женщину ', 'Мужчину'];

        foreach ($params as $param){

            $model = new Model();

            $model->value = $param;
            $model->url = $translit->translit($param, true, 'ru-en');

            $model->save();

        }

    }
}