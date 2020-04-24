<?php


namespace frontend\components;

use yii\authclient\clients\VKontakte;

class VK extends VKontakte
{
    public $attributeNames = [
        'uid',
        'first_name',
        'last_name',
        'nickname',
        'screen_name',
        'sex',
        'bdate',
        'city',
        'country',
        'timezone',
        'email',
        'photo'
    ];
}