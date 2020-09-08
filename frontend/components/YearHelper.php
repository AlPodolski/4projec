<?php


namespace frontend\components;


class YearHelper
{
    public static function Year($year)
    {
        $year = (int)$year;

        $years = [
            'лет' => [
                14,15,16,17,18,19,20,25,26,27,28,29,30,35,36,37,38,39,40,45,46,47,48,49,50,55,56,57,58,59,60,65,66,67,68,69,70,75,76,77,78,79,80
            ],
            'год' => [
                21,31,41,51,61,71
            ],
            'года' => [
                22,23,24,32,33,34,42,43,44,52,53,54,62,63,64,72,73,74
            ]
        ];

        foreach ($years as $key => $value){
            if (\in_array($year, $value)) return $year.' ';
        }

        return $year;
    }
}