<?php


namespace frontend\modules\user\components\helpers;

use Yii;

class DropCacheHelper
{
    public static function dropUser($id)
    {
        Yii::$app->cache->delete(Yii::$app->params['cache_name']['detail_profile_cache_name'].$id);
    }
}