<?php


namespace frontend\modules\group\components\helpers;


use frontend\modules\group\models\Group;
use frontend\modules\user\models\News;
use frontend\modules\wall\models\Wall;
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

    public static function countSubscribers($groupId, $groupKey)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return $redis->scard ($groupKey.":{$groupId}:subscribes");
    }

    public static function addGroupPostToUserNews($groupId, $userId, $limit = 10)
    {

        $GroupWallItems = Wall::find()
            ->where(['user_id' => $groupId, 'class' => Group::class])
            ->limit($limit)
            ->orderBy('id DESC')
            ->asArray()
            ->all();

        if ($GroupWallItems){

            foreach ($GroupWallItems as $groupWallItem){

                $feedItem = new News();
                $feedItem->user_id = $userId;
                $feedItem->timestamp = \time();
                $feedItem->related_class = Wall::class;
                $feedItem->news_id = $groupWallItem['id'];
                $feedItem->save();

            }

        }

    }

}