<?php


namespace console\controllers;

use yii\console\Controller;
use dastanaron\translit\Translit;
use common\models\Education as Model;

class ImportController extends Controller
{
    public function actionIndex()
    {

        $translit = new Translit();

        $params = ['среднее', 'среднее специальное', 'неполное высшее', 'высшее', 'несколько высших', 'ученая степень'];

        foreach ($params as $param){

            $model = new Model();

            $model->value = $param;
            $model->url = \strtolower($translit->translit($param, true, 'ru-en'));

            $model->save();

        }

    }
}