<?php


namespace frontend\modules\user\components\helpers;


use frontend\modules\events\models\Events;
use Yii;

class GuestHelper
{
    public static function addGuest($who_id, $whom_id)
    {

        if (!Events::find()->where(['user_id' => $whom_id, 'from' => $who_id, 'status' => 0])->count()){

            $event = new Events();

            $event->type = Events::NEW_GUEST;
            $event->status = Events::STATUS_NOT_READ;
            $event->user_id = $whom_id;
            $event->from = $who_id;
            $event->timestamp = \time();

            $event->save();

        }

    }
}