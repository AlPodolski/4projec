<?php


namespace frontend\modules\user\components\helpers;


class TimeHelper
{
    public static function getTimestampFromString($string){

        return strtotime($string);

    }
}