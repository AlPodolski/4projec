<?php


namespace frontend\components\helpers;


class MetaFilterHelper
{
    public static function Filter($string)
    {
        if (\strstr($string, 'мужчин') or \strstr($string, 'женщин') ){
            return $string;
        }

        return 'Пользователи '.$string;
    }
}