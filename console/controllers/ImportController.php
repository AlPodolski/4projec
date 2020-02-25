<?php


namespace console\controllers;

use yii\console\Controller;
use dastanaron\translit\Translit;
use common\models\VajnoeVPartnere;

class ImportController extends Controller
{
    public function actionIndex()
    {

        $translit = new Translit();

        $params = ['фигура', 'смазливое лицо', 'ум', 'характер', 'секс', 'материальнгое положение'];

        foreach ($params as $param){

            $model = new VajnoeVPartnere();

            $model->value = $param;
            $model->url = $translit->translit($param, true, 'ru-en');

            $model->save();

        }

    }
}