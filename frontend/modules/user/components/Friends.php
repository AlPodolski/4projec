<?php
namespace frontend\modules\user\components;


use frontend\modules\wall\components\LikeHelper;
use Yii;
use yii\redis\Connection;

class Friends
{
    public static function addToFriends($who_id, $whom_id)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return $redis->sadd("friends:{$who_id}:friends", $whom_id) and $redis->sadd("friends:{$whom_id}:friends", $who_id);
    }

    /**
     * @param $who_id integer кто
     * @param $whom_id  integer кому
     * @return bool
     */
    public static function isFriends($who_id, $whom_id){
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return (bool) $redis->sismember("friends:{$whom_id}:friends", $who_id) or $redis->sismember("friends:{$who_id}:friends", $whom_id);
    }

    public static function removeFriend($who_id, $whom_id){
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return (bool) $redis->srem("friends:{$whom_id}:friends", $who_id) and $redis->srem("friends:{$who_id}:friends", $whom_id);
    }

    //SMEMBERS
    public static function getFriendsIds($who_id){
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return $redis->smembers ("friends:{$who_id}:friends");
    }

}