<?php


namespace frontend\modules\group\models\forms;

use frontend\components\events\NewsCreatedEvent;
use frontend\components\service\FeedService;
use frontend\modules\wall\models\Wall;
use yii\base\Model;

class addGroupRecordItemForm extends Model
{
    public $text;
    public $user_id;
    public $group_id;
    public $class;
    public $file;

    const EVENT_POST_CREATED = 'post_created';

    public function rules()
    {
        return [
            [['text', 'class'], 'string'],
            [['user_id', 'group_id'], 'integer'],
        ];
    }

    public function save()
    {

        $wall = new Wall();
        $wall->user_id = $this->group_id;
        $wall->from = $this->user_id;
        $wall->created_at = \time();
        $wall->text = $this->text;
        $wall->class = $this->class;

        if ($wall->save()) {

            $event = new NewsCreatedEvent();
            $event->wall = $wall;
            $this->trigger(self::EVENT_POST_CREATED, $event);
            return $wall;

        }


        return false;

    }

    public function __construct()
    {
        $this->on(self::EVENT_POST_CREATED, [FeedService::class, 'addToFeeds']);

        parent::__construct();
    }

}