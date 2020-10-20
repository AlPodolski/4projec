<?php

namespace chat\modules\chat\components\helpers;

use chat\modules\chat\models\Message;
use frontend\modules\chat\components\helpers\GetDialogsHelper as Helper;
use frontend\modules\chat\models\relation\UserDialog;
use yii\helpers\ArrayHelper;

class GetDialogsHelper extends Helper
{
    public static function getDialogs($user_id){

        $notReadMessageDialogsIds = Message::find()->where(['status' => 0])->andWhere(['type' => 1])->select('chat_id')->groupBy('chat_id')->asArray()->all();

        $notReadMessageDialogsIds = ArrayHelper::getColumn($notReadMessageDialogsIds, 'chat_id');

        return $dialogList = UserDialog::find()->where(['in', 'user_id',  $user_id])
            ->andWhere(['in', 'dialog_id', $notReadMessageDialogsIds])
            ->orderBy('id DESC')->with('companion')
            ->with('lastMessage')
            ->all();

    }

}