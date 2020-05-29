<?php


namespace frontend\modules\sympathy\components\helpers;


use frontend\models\UserPol;
use frontend\modules\sympathy\models\SympathySetting;
use frontend\modules\user\models\Profile;
use Yii;
use yii\helpers\ArrayHelper;
use yii\redis\Connection;

class SympathyHelper
{
    /**
     * @param $key
     * @param $item_id //кому нужно добавить симпатию
     * @param $user_id //кого нужно добавить в симпатии
     */
    public static function add($key, $item_id, $user_id)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;

        if(  !(bool) $redis->sismember($key.":{$item_id}:sympathy", $user_id) ){
            $redis->sadd($key.":{$item_id}:sympathy", $user_id);
        }

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