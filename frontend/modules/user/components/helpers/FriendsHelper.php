<?php


namespace frontend\modules\user\components\helpers;


use frontend\modules\user\models\Friends;

class FriendsHelper
{
    public static function isFiends($who_id, $whom_id)
    {
        return (bool) Friends::find()->where(['user_id' => $whom_id])->andWhere(['friend_user_id' => $who_id])->one();
    }

    public static function confirmFriendship($who_id, $whom_id){

        if (!FriendsHelper::isFiends($who_id, $whom_id) and FriendsRequestHelper::isFiendsRequest($who_id, $whom_id) and FriendsRequestHelper::removeFriendsRequest($who_id, $whom_id)){

            return FriendsHelper::addToFriends($who_id, $whom_id) && FriendsHelper::addToFriends( $whom_id, $who_id);

        }

        return false;

    }

    public static function deleteFriend($who_id, $whom_id){

        return self::deleteItem($who_id) && self::deleteItem($whom_id);

    }

    public static function deleteItem($who_id){

        if ($friend = Friends::find()->where(['user_id' => $who_id])->one()) return $friend->delete();

        return false;

    }

    public static function addToFriends($who_id, $whom_id){

        $friend = new Friends();

        $friend->user_id = $who_id;
        $friend->friend_user_id = $whom_id;

        return $friend->save();

    }
}