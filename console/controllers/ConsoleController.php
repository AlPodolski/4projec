<?php


namespace console\controllers;

use common\models\City;
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

        $names = ['Групповой', 'секс', 'Глубокий',
            'Пасс', 'Взаимные', 'Встречаемся',
            'Начинающая', 'Виртуальный', 'Сделаю',
            'Помогу', 'Попробую', 'Мастурбация', 'Шалю',
            'Кто', 'Страпон', 'Взаимная', 'Мне', 'Хочу',
            'ара', 'Куни', 'Актив', 'Подрочу', 'Парень',
            'Ледибой', 'Нижняя', 'Молодая', 'Virtik', 'virt',
            'вирт', 'одинокие', 'Стоячий', 'По ', 'Би'];

        foreach ($names as $nane){

            if($profiles = Profile::find()->asArray()->where([ 'like' , 'username' , $nane])->asArray()->all()){

                foreach ($profiles as $profile){

                    Wall::deleteAll(['from' => $profile['id']]);

                    if ($friends = \frontend\modules\user\components\Friends::getFriendsIds($profile['id'])){

                        foreach ($friends as $friend){

                            FriendsHelper::deleteFriend($profile['id'], $friend);

                        }

                    }

                    if ($photo = Photo::find()->where(['user_id' => $profile['id'] ] )->asArray()->all() ){

                        foreach ($photo as $item){

                            if (isset ($item['file']) and !empty($item['file']) and \file_exists($path.'/web'.$item['file'])) unlink($path.'/web'.$item['file']);

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

    public function actionDns(){

        $citys = City::find()->asArray()->all();

        $host = Yii::$app->params['site_name'];
        $ip = Yii::$app->params['server_ip'];

        foreach ($citys as $city){

            //$city = $city['city'];


            echo $city['url'];


            $content = array(
                'type' => "A",
                'name' => $city['url'],
                'content' => $ip,

            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://api.cloudflare.com/client/v4/zones/bc5cb29c869f8ab1fce24e63a175c9d4/dns_records");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($content));  //Post Fields
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $headers = [
                'X-Auth-Email: '.Yii::$app->params['cloud_email'],
                'X-Auth-Key: '.Yii::$app->params['cloud_api'],
                'Content-Type: application/json',
            ];

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $server_output = curl_exec ($ch);

            $object = json_decode($server_output);

            if (!isset($object->result->id)) continue;

            $zapid = $object->result->id;


            curl_close ($ch);

            // пытаемся поставить галочку на облаке
            $zoneindetif="https://api.cloudflare.com/client/v4/zones/bc5cb29c869f8ab1fce24e63a175c9d4/dns_records/$zapid";


            $content = array(
                'type' => "A",
                'name' => $city['url'],
                'content' => $ip,
                'proxied' => true,
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$zoneindetif);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($content));

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $headers = [
                'X-Auth-Email: '.Yii::$app->params['cloud_email'],
                'X-Auth-Key: '.Yii::$app->params['cloud_api'],
                'Content-Type: application/json',
            ];

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $server_output = curl_exec ($ch);

        }

    }
}