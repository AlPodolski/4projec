<?php


namespace console\controllers;

use yii\console\Controller;
use dastanaron\translit\Translit;
use common\models\Children;

class ImportController extends Controller
{
    public function actionIndex()
    {

        $translit = new Translit();

        $params = ['нет', 'нет и не хочу', 'нет, но хотелось бы', 'нет, но скоро будут', 'есть, живем вместе', 'есть, живем порознь'];

        foreach ($params as $param){

            $model = new Children();

            $model->value = $param;
            $model->url = $translit->translit($param, true, 'ru-en');

            $model->save();

        }

    }
}