<?php

namespace frontend\modules\chat\components\helpers;

use frontend\modules\chat\models\relation\UserDialog;

class GetDialogsHelper
{
    public static function getDialogs($user_id){

        if ($dialogList = UserDialog::find()->where(['user_id' => $user_id])->asArray()->all()){

            foreach ($dialogList as &$dialog){



            }

        }
    }
}