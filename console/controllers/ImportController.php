<?php


namespace console\controllers;

use yii\console\Controller;
use dastanaron\translit\Translit;
use common\models\Haracter as Model;

class ImportController extends Controller
{
    public function actionIndex()
    {

        $translit = new Translit();

        $params = ['аккуратный', 'вежливый', 'верный', 'весёлый', 'влюбчивый', 'внимательный', 'воспитанный', 'гордый', 'добрый', 'доверчивый', 'дружелюбный', 'заботливый', 'застенчивый', 'легкомысленный', 'надёжный', 'нежный', 'нервный', 'обидчивый', 'оптимистичный', 'покладистый', 'пошлый', 'пунктуальный', 'ранимый', 'ревнивый', 'решительный', 'романтичный', 'смелый', 'собственник', 'справедливый', 'терпеливый', 'трудолюбивый', 'упрямый', 'хитрый', 'целеустремленный', 'чистоплотный', 'честный', 'эгоистичный', 'энергичный'];

        foreach ($params as $param){

            $model = new Model();

            $model->value = $param;
            $model->url = \strtolower($translit->translit($param, true, 'ru-en'));

            $model->save();

        }

    }
}