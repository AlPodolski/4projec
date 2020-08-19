<?php


namespace frontend\components\service;

use frontend\modules\group\components\helpers\SubscribeHelper;
use frontend\modules\group\models\Group;
use frontend\modules\user\components\Friends;
use frontend\modules\user\models\News;
use frontend\modules\user\models\Profile;
use frontend\modules\wall\models\Wall;
use Yii;
use yii\base\Component;


class FeedService extends Component
{

    public function addToFeeds(\yii\base\Event $event)
    {

        if ($event->wall->class == Group::class){

            $followers = SubscribeHelper::getGroupSubscribers($event->wall->user_id, Yii::$app->params['group_subscribe_key']);

        }

        if ($event->wall->class == Profile::class){

            $followers =  Friends::getFriendsIds($event->wall->user_id);

        }

        if ($followers){

            foreach ($followers as $follower) {
                $feedItem = new News();
                $feedItem->user_id = $follower;
                $feedItem->related_class = Wall::class;
                $feedItem->news_id = $event->wall->id;
                $feedItem->save();
            }

        }

    }

    private function getSubscriber($class, $id){



    }

}