<?php


namespace frontend\components\helpers;


use Yii;

class SocketHelper
{
    public static function send_notification(array $params){

        Yii::$app->params['send_params'] = $params;

        \Ratchet\Client\connect(Yii::$app->params['websoket_addr'])->then(function($conn) {

            $conn->send(\json_encode(Yii::$app->params['send_params']));

            }, function ($e) {
                echo "Could not connect: {$e->getMessage()}\n";
            });
    }
}