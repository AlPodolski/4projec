<?php


namespace frontend\modules\group\components\helpers;


use Yii;
use yii\redis\Connection;

class SubscribeHelper
{
    public static function Subscribe($groupId, $userId, $groupKey, $userGroupKey)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;

        if(  (bool) $redis->sismember($groupKey.":{$groupId}:subscribes", $userId) ){

            if ((bool) $redis->sismember($userGroupKey.":{$userId}:subscribe", $groupId)){

                $redis->srem($userGroupKey.":{$userId}:subscribe", $groupId);

            }

            $redis->srem($groupKey.":{$groupId}:subscribes", $userId);

        }else{

            if (!(bool) $redis->sismember($userGroupKey.":{$userId}:subscribe", $groupId)){

                $redis->sadd($userGroupKey.":{$userId}:subscribe", $groupId);

            }

            $redis->sadd($groupKey.":{$groupId}:subscribes", $userId);

        }

    }

    public static function getUserSubscribe($userId, $userGroupKey)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;

        return $redis->smembers($userGroupKey.":{$userId}:subscribe");
    }

    public static function getGroupSubscribers($groupId, $groupKey)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;

        return $redis->smembers($groupKey.":{$groupId}:subscribes");
    }

    public static function isSubscribe($groupId, $userId, $key)
    {
        /* @var $redis Connection */

        $redis = Yii::$app->redis;

        return (bool) $redis->sismember($key.":{$groupId}:subscribes", $userId);
    }

}