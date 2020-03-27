<?php

namespace frontend\modules\wall\components;

use Yii;
use yii\redis\Connection;

class LikeHelper
{
    public static function like($user_id, $item_id , $key ){

        /* @var $redis Connection */
        $redis = Yii::$app->redis;

        if(  (bool) $redis->sismember($key.":{$item_id}:likes", $user_id) ){
            $redis->srem($key.":{$item_id}:likes", $user_id);
        }else{
            $redis->sadd($key.":{$item_id}:likes", $user_id);
        }

    }

    public static function isLiked($user_id, $item_id , $key){

        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return (bool) $redis->sismember($key.":{$item_id}:likes", $user_id);

    }
}