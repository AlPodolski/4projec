<?php


namespace frontend\components\helpers;


use Yii;

class SocketHelper
{
    public static function send_notification(array $params){

        Yii::$app->params['send_params'] = $params;

        $socket = @fsockopen(Yii::$app->params['websoket_addr_with_not_port_and_protocol'], Yii::$app->params['websoket_post'], $errno, $errstr, 5);

        if ($socket){

            \Ratchet\Client\connect(Yii::$app->params['websoket_addr'])->then(function($conn) {

                $conn->send(\json_encode(Yii::$app->params['send_params']));

            }, function ($e) {
                echo "Could not connect: {$e->getMessage()}\n";
            });

        }

    }
}