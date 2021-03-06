<?php


namespace frontend\components\service\advertisin;

use frontend\components\service\advertisin\models\City;
use frontend\components\service\advertisin\models\Posts;

class AdvertisingService
{
    public static function getAdvertising($city)
    {

        if ($city == 'msk' ) $city = 'moskva';

        $cityId = City::find()->where(['url' => $city])->asArray()->one();

        return Posts::find()
            ->where(['city_id' => $cityId['id']])
            ->with('avatar')
            ->limit(30)
            ->cache(3600 * 24)
            ->all();

    }
}