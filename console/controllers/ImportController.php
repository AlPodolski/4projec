<?php


namespace console\controllers;

use yii\console\Controller;
use dastanaron\translit\Translit;
use common\models\Family;

class ImportController extends Controller
{
    public function actionIndex()
    {

        $translit = new Translit();

        $params = ['холост', 'одинока', 'замужем', 'женат', 'разведен', 'разведена', "вдова", 'вдовец', 'гражданский брак', 'встречаемся', 'все сложно', 'в активном поиске'];

        foreach ($params as $param){

            $model = new Family();

            $model->value = $param;
            $model->url = $translit->translit($param, true, 'ru-en');

            $model->save();

        }

    }
}