<?php

namespace chat\modules\chat\components\helpers;

use frontend\modules\chat\components\helpers\GetDialogsHelper as Helper;
use frontend\modules\chat\models\relation\UserDialog;

class GetDialogsHelper extends Helper
{
    public static function getDialogs($user_id){

        return $dialogList = UserDialog::find()->where(['in', 'user_id',  $user_id])->orderBy('id DESC')->with('companion')->with('lastMessage')->all();

    }

}