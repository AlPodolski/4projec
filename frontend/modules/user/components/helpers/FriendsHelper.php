<?php


namespace frontend\modules\user\components\helpers;


use frontend\modules\user\components\Friends;

class FriendsHelper
{
    public static function isFiends($who_id, $whom_id)
    {
        return (bool) Friends::isFriends($who_id, $whom_id);
    }

    public static function confirmFriendship($who_id, $whom_id){

        if (!FriendsHelper::isFiends($who_id, $whom_id) and FriendsRequestHelper::isFiendsRequest($who_id, $whom_id) and FriendsRequestHelper::removeFriendsRequest($who_id, $whom_id)){

            return FriendsHelper::addToFriends($who_id, $whom_id);

        }

        return false;

    }

    public static function deleteFriend($who_id, $whom_id){

        return Friends::removeFriend($who_id, $whom_id);

    }

    public static function addToFriends($who_id, $whom_id){

        return Friends::addToFriends($who_id, $whom_id);

    }
}