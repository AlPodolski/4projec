<?php


namespace frontend\modules\user\components\helpers;


use frontend\modules\user\models\Friends;

class FriendsHelper
{
    public static function isFiends($who_id, $whom_id)
    {
        return (bool) Friends::find()->where(['user_id' => $whom_id])->andWhere(['friend_user_id' => $who_id])->one();
    }
}