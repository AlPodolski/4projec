<?php


namespace frontend\modules\user\components\helpers;

use frontend\modules\user\models\FriendsRequest;

class FriendsRequestHelper
{
    public static function isFiendsRequest($who_id, $whom_id)
    {
        return (bool) FriendsRequest::find()->where(['user_id' => $whom_id, 'request_user_id' => $who_id])->count();
    }

    public static function removeFriendsRequest($who_id, $whom_id){

        if ($friendsRequest = FriendsRequest::find()->where(['user_id' => $whom_id])->andWhere(['request_user_id' => $who_id])->one()){

            return $friendsRequest->delete();

        }

        return false;

    }
}