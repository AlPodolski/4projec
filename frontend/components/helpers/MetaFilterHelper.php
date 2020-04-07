<?php


namespace frontend\components\helpers;


class MetaFilterHelper
{
    public static function Filter($string)
    {
        if (\strstr($string, 'Мужчин') or \strstr($string, 'Женщи') ){
            return $string;
        }

        return 'Пользователи '.$string;
    }
}