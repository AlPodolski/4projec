<?php


namespace frontend\modules\sympathy\components\helpers;


use frontend\models\UserPol;
use frontend\modules\events\models\Events;
use frontend\modules\sympathy\models\SympathySetting;
use frontend\modules\user\models\Profile;
use Yii;
use yii\helpers\ArrayHelper;
use yii\redis\Connection;

class SympathyHelper
{
    const ADD_NEW_SYMPATHY = 'new_synpathy';
    const ADD_MUTUAL_SYMPATHY = 'mutual_synpathy';

    /**
     * @param $item_id //кому нужно добавить симпатию (кому понравился)
     * @param $user_id //кого нужно добавить в симпатии (кто понравился)
     * @return  string
     */
    public static function add($item_id, $user_id)
    {

        if (SympathyHelper::set(Yii::$app->params['users_who_like_key'], $item_id, $user_id)
            and SympathyHelper::set(Yii::$app->params['users_whom_like_key'], $user_id,  $item_id)){

            if (self::checkReciprocity($item_id, $user_id)) {

                if (SympathyHelper::addEvent($user_id, $item_id,Events::MUTUAL_SYMPATHY )
                    and SympathyHelper::addEvent($item_id, $user_id,Events::MUTUAL_SYMPATHY ))
                    return SympathyHelper::ADD_MUTUAL_SYMPATHY;

            }else{

                if (SympathyHelper::addEvent($user_id, $item_id,Events::NEW_SYMPATHY )) return SympathyHelper::ADD_NEW_SYMPATHY ;

            }

        }

    }

    public static function addEvent($user_id, $item_id, $type)
    {
        $event = new Events();

        $event->user_id = $user_id;
        $event->timestamp = \time();
        $event->from = $item_id;
        $event->type = $type;

        return $event->save();
    }

    public static function checkReciprocity($user_id,  $item_id)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;

        return (bool) $redis->sismember(Yii::$app->params['users_who_like_key'].":{$item_id}:sympathy", $user_id)
            && $redis->sismember(Yii::$app->params['users_whom_like_key'].":{$user_id}:sympathy", $item_id);
    }

    public static function set($key, $item_id, $user_id)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;

        if(  !(bool) $redis->sismember($key.":{$item_id}:sympathy", $user_id) ){
            return (bool) $redis->sadd($key.":{$item_id}:sympathy", $user_id);
        }

        return false;
    }

    public static function get($item_id, $key)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return $redis->smembers ($key.":{$item_id}:sympathy");
    }

    public static function getProfile($user_id, $not_in_id)
    {
        $sympathySettings = SympathySetting::find()->where(['user_id' => $user_id])->one();

        $post = Profile::find();

        if ($sympathySettings){

            $userPol = UserPol::find()
                ->where(['pol_id' => $sympathySettings->pol_id])
                ->andWhere(['not in', 'user_id', $not_in_id]);
            if ($sympathySettings->city_id) $userPol->andWhere(['city_id' => $sympathySettings->city_id]);
            $userPol = $userPol->asArray()->all();

            $userPol = ArrayHelper::getColumn($userPol, 'user_id');

            $post->andWhere(['in' , 'id' , $userPol]);

            $age_from = AgeHelper::prepareAge($sympathySettings->age_from);
            $age_to = AgeHelper::prepareAge($sympathySettings->age_to);

            $post->andWhere(['<=', 'birthday' , \time() - $age_from]);
            $post->andWhere(['>=', 'birthday' , \time() - $age_to]);

            $post->limit(1);

        }

        $post->asArray();

        return $post->one();
    }
}