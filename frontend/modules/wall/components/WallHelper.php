<?php


namespace frontend\modules\wall\components;

use common\models\Comments;
use frontend\modules\wall\models\Wall;
use Yii;
use yii\redis\Connection;

class WallHelper
{
    public static function deleteItem($user_id, $item_id){

        $item = Wall::find()->where(['user_id' => $user_id])->orWhere(['from' => $user_id])->andWhere(['id' => $item_id])->one();

        if (!empty($item)){

            $comments = Comments::find()->where(['class' => Wall::class])->andWhere(['related_id' => $item->id])->all();

            if (!empty($comments)){

                foreach ($comments as  $comment ){

                    $comment->delete();
                }

            }

            /* @var $redis Connection */
            $redis = Yii::$app->redis;
            $redis->del(Yii::$app->params['wall_item_redis_key'].":{$item_id}:likes");

            $item->delete();
        }

    }

}