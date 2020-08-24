<?php

namespace chat\modules\chat\components\helpers;

use frontend\modules\chat\components\helpers\GetDialogsHelper as Helper;
use frontend\modules\chat\models\Message;
use frontend\modules\chat\models\relation\UserDialog;
use yii\helpers\ArrayHelper;

class GetDialogsHelper extends Helper
{
    public static function getDialogs($user_id){

        $notReadMessageDialogId = ArrayHelper::getColumn(Message::find()->select('chat_id')->groupBy('chat_id')->where(['status' => 0])
            ->asArray()->all(), 'chat_id');

        $usersWithOpenDialogs = ArrayHelper::getColumn(\chat\modules\chat\models\relation\UserDialog::find()
            ->where(['in', 'dialog_id', $notReadMessageDialogId])
            ->AndWhere(['in', 'user_id', $user_id])
            ->select('user_id')->asArray()->groupBy('user_id')->all(), 'user_id');


        return $dialogList = UserDialog::find()->where(['in', 'user_id', $usersWithOpenDialogs])->with('companion')->with('lastMessage')->all();

    }

}