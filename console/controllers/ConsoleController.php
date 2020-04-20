<?php


namespace console\controllers;

use common\models\FilterParams;
use frontend\modules\user\components\helpers\FriendsHelper;
use frontend\modules\user\components\helpers\SaveAnketInfoHelper;
use frontend\modules\user\models\Friends;
use frontend\modules\user\models\Photo;
use frontend\modules\user\models\Profile;
use frontend\modules\wall\models\Wall;
use Yii;
use yii\console\Controller;

class ConsoleController extends Controller
{
    public function actionFriends()
    {
        $profiles = Profile::find()->asArray()->all();

        foreach ($profiles as $profile){

            if (!(bool)Friends::find()->where(['user_id' => $profile['id']])->asArray()->count()){
                $my_city = \rand(5, 25);
                $not_my_city = \rand(1, 8);

                $profiles_from_my_city = Profile::find()->where(['city' => $profile['city']])
                    ->orderBy(['rand()' => SORT_DESC])->limit($my_city)->asArray()->all();

                $profiles_not_from_my_city = Profile::find()->orderBy(['rand()' => SORT_DESC])->limit($not_my_city)
                    ->asArray()->all();

                foreach ($profiles_from_my_city as $profiles_from_my_city_item){

                    if (!FriendsHelper::isFiends($profile['id'], $profiles_from_my_city_item['id'])){

                        FriendsHelper::addToFriends($profiles_from_my_city_item['id'], $profile['id']);

                    }

                }
                foreach ($profiles_not_from_my_city as $profiles_not_from_my_city_item){

                    if (!FriendsHelper::isFiends($profile['id'], $profiles_not_from_my_city_item['id'])){

                        FriendsHelper::addToFriends($profiles_not_from_my_city_item['id'], $profile['id']);

                    }

                }
            }

        }
    }

    public function actionRemoveUsers()
    {

        $path = \str_replace('console', 'frontend',Yii::getAlias('@app') );

        $profiles = Profile::find()->asArray()->all();

        foreach ($profiles as $profile){

            if(substr_count($profile['username'], ' ') > 2){

                Wall::deleteAll(['from' => $profile['id']]);

                if ($friends = \frontend\modules\user\components\Friends::getFriendsIds($profile['id'])){

                    foreach ($friends as $friend){

                        FriendsHelper::deleteFriend($profile['id'], $friend);

                    }

                }

                if ($photo = Photo::find()->where(['user_id' => $profile['id'] ] )->asArray()->all() ){

                    foreach ($photo as $item){

                        if (\file_exists($path.'/web'.$item['file'])) unlink($path.'/web'.$item['file']);

                    }

                    Photo::deleteAll(['user_id' =>$profile['id'] ] );

                }

                $filterParams = FilterParams::find()->asArray()->all();


                foreach ($filterParams as $filterParam){

                    if (!empty($filterParam['relation_class']) and !empty($filterParam['class_name'])) $filterParam['relation_class']::deleteAll('user_id = '.$profile['id']);

                }

                Profile::deleteAll('id = '.$profile['id']);

            }

        }
    }
}