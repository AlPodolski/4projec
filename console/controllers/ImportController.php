<?php


namespace console\controllers;

use yii\console\Controller;
use dastanaron\translit\Translit;
use common\models\CeliZnakomstvamstva as Model;

class ImportController extends Controller
{
    public function actionIndex()
    {

        $translit = new Translit();

        $params = ['дружба и общение', 'переписка', 'любовь и отношения', 'встречи', 'создание семьи', 'совместные путешествия', 'Реальный секс', 'Виртуальный секс', 'Обмен фото и видео'];

        foreach ($params as $param){

            $model = new Model();

            $model->value = $param;
            $model->url = \strtolower($translit->translit($param, true, 'ru-en'));

            $model->save();

        }

    }
}