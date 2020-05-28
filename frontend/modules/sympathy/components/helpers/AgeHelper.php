<?php


namespace frontend\modules\sympathy\components\helpers;


class AgeHelper
{
    public static function prepareAge($age)
    {
        return $age * (3600 * 24 * 365);
    }
}