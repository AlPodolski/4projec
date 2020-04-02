<?php

namespace frontend\modules\chat\components\helpers;

use frontend\modules\chat\models\Message;
use frontend\modules\chat\models\relation\UserDialog;

class GetDialogsHelper
{
    public static function getDialogs($user_id){

        return $dialogList = UserDialog::find()->where(['user_id' => $user_id])->with('companion')->with('lastMessage')->all();

    }

    public static function getDialog($dialog_id){

        return $dialogList = UserDialog::find()->where(['dialog_id' => $dialog_id])->with('message')->asArray()->one();

    }

    public static function getCompanion($user_id, $chat_id){

        return $dialogList = UserDialog::find()->where(['dialog_id' => $chat_id])->andWhere(['user_id' => $user_id])->asArray()->one();

    }

    public static function serRead($chat_id, $user_id){

        Message::updateAll(['status' => 1], [ 'and',  ['chat_id' => $chat_id] , ['<>', 'from' ,$user_id ]]);

    }

}