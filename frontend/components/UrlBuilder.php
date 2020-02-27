<?php


namespace frontend\components;


use Yii;

class UrlBuilder
{
    public static function buildUrlForFilter($old_url, $new_param){

        if (isset($old_url[0]) and strstr($old_url[0], 'anketa')) return trim($new_param,'/');

        $new_param = trim($new_param, '/');

        if (!is_array($old_url)) return $old_url.$new_param;

        $old_url[] = $new_param;

        $old_url = array_unique(array_flip($old_url));

        ksort($old_url);

        $old_url = self::sortUrlParams($old_url);

        return $url = str_replace('//', '/', implode('/',array_keys($old_url)));

    }

    public static function sortUrlParams(array $url){

        foreach ($url as $key => $value){

            if (\in_array($key, Yii::$app->params['sort_url'])){

                $param[$key] = $url[$key];

                unset($url[$key]);

                $url = \array_merge($param, $url);

            }

        }

        return ($url);

    }

}