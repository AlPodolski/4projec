<?php


namespace frontend\components\helpers;


class MetaFilterHelper
{
    public static function Filter($string)
    {
        if (\strstr(\mb_strtolower($string), 'мужчин') or \strstr(\mb_strtolower($string), 'женщи') or \strstr(\mb_strtolower($string), 'ользовател')){
            return $string;
        }

        return 'Пользователи '.$string;
    }
}