<?php


namespace frontend\modules\user\models\forms;
use yii\base\Model;

class Params extends Model
{
    public $hair_color;
    public $eye_color;
    public $rost;
    public $ves;
    public $body;
    public $breast_size;

    public function attributeLabels()
    {
        return [
            'hair_color' => 'Цвет волос',
            'rost' => 'Рост',
            'ves' => 'Вес',
            'eye_color' => 'Цвет глаз',
            'body' => 'Телосложение',
            'breast_size' => 'Размер груди',
        ];

    }

}