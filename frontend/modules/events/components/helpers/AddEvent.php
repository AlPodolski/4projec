<?php

namespace frontend\modules\events\components\helpers;

use frontend\modules\events\models\Events;

class AddEvent
{
    public static function Add( int $from, int $to, int $type , int $related_id = 0 , string $class = '')
    {
        $event = new Events();

        $event->class = $class;
        $event->from = $from;
        $event->user_id = $to;
        $event->timestamp = \time();
        $event->type = $type;
        $event->status = 0;
        $event->related_id = $related_id;

        return $event->save();
    }
}