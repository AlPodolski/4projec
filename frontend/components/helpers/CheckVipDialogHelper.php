<?php

namespace frontend\components\helpers;

use Yii;
use yii\redis\Connection;

class CheckVipDialogHelper
{

    public static function addDialogIdToDay($user_id, $dialog_id)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        $day = \date('w');
        $redis->sadd("dialog_day_{$day}:{$user_id}", $dialog_id);
        $redis->expire("dialog_day_{$day}:{$user_id}", 3600 * 24);
    }

    public static function checkExistDialogId($user_id, $dialog_id)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        $day = \date('w');
        return (bool) $redis->sismember("dialog_day_{$day}:{$user_id}", $dialog_id);
    }

    public static function countDayDialogs($user_id)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        $day = \date('w');
        return $redis->scard ("dialog_day_{$day}:{$user_id}");
    }

    public static function checkLimitDialog($user, $limit)
    {
        $countDialog = self::countDayDialogs($user);

        \dd($countDialog);

        if ($countDialog < $limit) return true;

        return false;

    }
}