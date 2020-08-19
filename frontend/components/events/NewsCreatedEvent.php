<?php


namespace frontend\components\events;

use frontend\modules\wall\models\Wall;
use yii\base\Event;

class NewsCreatedEvent extends Event
{
    /**
     * @var Wall
     */
    public $wall;

    public function getWall() : Wall
    {
        return $this->wall;
    }



}