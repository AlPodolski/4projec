<?php


namespace frontend\components\helpers;

use Yii;

class PromoHelper
{
    public static function addCookie()
    {
        $cookies = Yii::$app->request->cookies;

        if ($cookies->getValue('promo') === null){

            $cookiesResponse = Yii::$app->response->cookies;

            $cookiesResponse->add(new \yii\web\Cookie([
                'name' => 'promo',
                'value' => '1',
                'expire' => \time() + (3600 * 25 * 365)
            ]));

        }

    }
}