<?php


namespace console\controllers;

use chat\modules\chat\models\Message;
use common\models\City;
use common\models\FilterParams;
use common\models\FinancialSituation;
use frontend\models\Files;
use frontend\models\relation\TaborUser;
use frontend\models\UserFinancialSituation;
use frontend\models\UserPol;
use frontend\modules\chat\components\helpers\GetDialogsHelper;
use frontend\modules\chat\models\Chat;
use frontend\modules\chat\models\forms\SendMessageForm;
use frontend\modules\chat\models\relation\UserDialog;
use frontend\modules\events\models\Events;
use frontend\modules\sympathy\components\helpers\SympathyHelper;
use frontend\modules\user\components\helpers\FriendsHelper;
use frontend\modules\user\models\Friends;
use frontend\modules\user\models\Photo;
use frontend\modules\user\models\Profile;
use frontend\modules\user\models\UserPrivacySetting;
use frontend\modules\wall\models\Wall;
use Yii;
use yii\console\Controller;
use yii\helpers\ArrayHelper;

class ConsoleController extends Controller
{
    public function actionFriends()
    {
        $profiles = Profile::find()->asArray()->where(['email' => 'adminadultero@mail.com'])->all();

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

            if($profiles = Profile::find()->asArray()->where([ 'created_at' => '1590733199'])->asArray()->all()){

                foreach ($profiles as $profile){

                    Wall::deleteAll(['from' => $profile['id']]);

                    if ($friends = \frontend\modules\user\components\Friends::getFriendsIds($profile['id'])){

                        foreach ($friends as $friend){

                            FriendsHelper::deleteFriend($profile['id'], $friend);

                        }

                    }

                    if ($photo = Photo::find()->where(['user_id' => $profile['id'] ] )->asArray()->all() ){

                        /*foreach ($photo as $item){

                            if (isset ($item['file']) and !empty($item['file']) and \file_exists($path.'/web'.$item['file'])) unlink($path.'/web'.$item['file']);

                        }*/

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

    public function actionMakeJson()
    {
        $city = City::find()->asArray()->all();

        $result = array();

        foreach ($city as $cityItem){

            $users = Profile::find()->where(['email' => 'adminadultero@mail.com'])->andWhere(['city' => $cityItem['url']])->asArray()->all();

            if ($users){

                $result[] = array($cityItem['url'] => $users);

            }

        }

        \file_put_contents('result_json.json',\json_encode($result));

    }

    public function actionUpdateTime()
    {
        $posts = Profile::find()->where(['fake' => 0])
            ->orderBy(['rand()' => SORT_DESC])
            ->with('polValue')
            ->limit(2500)
            ->asArray()
            ->all();

        $deleteIds = array();
        $deleteIdsWoman = array();

        foreach ($posts as $key => $post){

            if ($post['polValue']['id'] == 1 ) $deleteIds[] = $key;

            if ($post['polValue']['id'] == 2  and  ($post['birthday'] < (\time() - (3600 * 24 * 365 * 33))) ) {

                $deleteIdsWoman[] = $key;

            }

        }

        foreach($deleteIds as $deleteIdsItem){

            if (\rand(0, 6) > 0 ) unset ($posts[$deleteIdsItem]) ;

        }
        foreach($deleteIdsWoman as $deleteIdsItem){

            unset ($posts[$deleteIdsItem]) ;

        }

        $postsIds = ArrayHelper::getColumn($posts, 'id');

        Profile::updateAll(['last_visit_time' => time()], ['in' , 'id' , $postsIds]);

    }

    public function actionStartDialog()
    {

        $profiles = Profile::find()->where(['fake' => 1])->asArray()->all();

        foreach ($profiles as $profile){

            $dialogCount = UserDialog::find()->where(['user_id' => $profile['id']])->count();

            if ($dialogCount < 3){

                $city = City::find()->where(['url' => $profile['city']])->asArray()->one();

                if ($userPol = UserPol::find()->where(['user_id' => $profile['id']])->asArray()->one()) {

                    $companionProfileId  = UserPol::find()->where(['<>' , 'user_id', $profile['id']])
                        ->andWhere(['city_id' => $city['id']])
                        ->andWhere(['<>', 'pol_id',$userPol['pol_id'] ])
                        ->asArray()
                        ->all();

                    $fromProfile = Profile::find()->where(['in', 'id', ArrayHelper::getColumn($companionProfileId, 'user_id')])
                        ->orderBy('rand()')
                        ->asArray()
                        ->andWhere(['fake' => 0])
                        ->limit(1)
                        ->one();

                    $this->sendMessage($fromProfile['id'], $profile['id'] );

                }else{

                    $companionProfileId  = UserPol::find()->where(['<>' , 'user_id', $profile['id']])
                        ->andWhere(['city_id' => $city['id']])
                        ->asArray()
                        ->all();

                    $fromProfile = Profile::find()->where(['in', 'id', ArrayHelper::getColumn($companionProfileId, 'user_id')])
                        ->orderBy('rand()')
                        ->asArray()
                        ->andWhere(['fake' => 0])
                        ->limit(1)
                        ->one();

                    $this->sendMessage($fromProfile['id'], $profile['id'] );

                }

            }

        }

    }

    public function actionWriteAnswer()
    {
        $messages = Message::find()->where(['status' => 0])->andWhere(['>', 'created_at', \time() - 310])->select('chat_id , from, message ,id')->asArray()->all();

        foreach ($messages as $message){

            if (!Message::find()->where(['chat_id' => $message['chat_id']])->andWhere(['<>', 'from', $message['from']])->count() ){

                $userInfo = UserDialog::find()->where(['dialog_id' => $message['chat_id']])->andWhere(['<>', 'user_id', $message['from']])
                ->asArray()->with('user')->one();

                if ($userInfo['user']['fake'] == 0 ){

                    $session_id = \md5($message['from'].$userInfo['id']);
                    $text = $message['message'];

                    $data = array(
                        'session_id' => $session_id,
                        'text'       => $text,
                    );

                    if ($curl = \curl_init()) {
                        \curl_setopt($curl, CURLOPT_URL, 'https://gdialog.prostitutki-13.com/message');
                        \curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        \curl_setopt($curl, CURLOPT_POST, true);
                        \curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                        $out = \curl_exec($curl);
                        \curl_close($curl);
                        if (strlen($out) < 500) {

                            $answerText = $out;

                            GetDialogsHelper::serRead($message['chat_id'], $userInfo['user']['id']);

                            $this->sendMessage($userInfo['user']['id'] , '', $message['chat_id'] , $answerText );

                        }

                    }

                }

            }

        }
    }

    public function actionAddGuest()
    {
         $notFakeUsers = Profile::find()->where(['fake' => 1])->asArray()->all();

         foreach ($notFakeUsers as $user){

             if (\rand(0,3) == 3){

                 $randUser = Profile::find()->where(['city' => $user['city'], 'fake' => 0])->orderBy('rand()')
                     ->asArray()->one();

                 $event = new Events();

                 $event->type = Events::NEW_GUEST;
                 $event->status = Events::STATUS_NOT_READ;
                 $event->user_id = $user['id'];
                 $event->from = $randUser['id'];
                 $event->timestamp = \time() - (60 + \rand(0, 900));

                 $event->save();

             }

         }
    }

    public function sendMessage($from, $to , $chat_id = false, $text = false)
    {

        $phrases = include Yii::getAlias('@app/files/phrases_to_start_a_dialogue.php');

        if (!$text){
            if (\rand(0, 3) != 2) $text = 'Привет';
            else $text = $phrases[\array_rand($phrases)];
        }

        $model = new SendMessageForm();

        $model->from_id = $from;
        $model->created_at = \time();
        $model->user_id = $to;
        if ($chat_id) $model->chat_id = $chat_id;
        $model->text = $text;

        $model->save();
    }

    public function actionSympathy()
    {
        $users = Profile::find()->where(['fake' => 1])->with('polRelation')->asArray()->all();

        foreach ($users as $user){

            if (\rand(0,1) == 1){

                if ($userPol = UserPol::find()->where(['user_id' => $user['id']])->asArray()->one()) {

                    $companionProfileId  = UserPol::find()->where(['<>' , 'user_id', $user['id']])
                        ->where(['<>', 'pol_id',$userPol['pol_id'] ])
                        ->asArray()
                        ->all();

                    $fromProfile = Profile::find()->where(['in', 'id', ArrayHelper::getColumn($companionProfileId, 'user_id')])
                        ->orderBy('rand()')
                        ->asArray()
                        ->andWhere(['fake' => 0])
                        ->limit(1)
                        ->one();

                    SympathyHelper::add($fromProfile['id'], $user['id']);

                }else{
                    $fromProfile = Profile::find()->where(['fake' => 0])
                        ->orderBy('rand()')
                        ->asArray()
                        ->limit(1)
                        ->one();

                    SympathyHelper::add($fromProfile['id'], $user['id']);
                }

            }

        }

    }

    public function actionMutualSympathy()
    {
        $posts = Profile::find()->where(['fake' => 1])->asArray()->all();

        foreach ($posts as $post){

            $postSetSympathy = SympathyHelper::get($post['id'] , Yii::$app->params['users_who_like_key']);

            $postSkipSympathy = SympathyHelper::get($post['id'] , Yii::$app->params['users_who_like_skip_key']);

            $resultIds = \array_diff($postSetSympathy, $postSkipSympathy);

            if ($resultIds){

                foreach ($resultIds as $resultId){

                    if (\rand(0,2) == 2){

                        if($mutualSympathyPost = Profile::find()->where(['fake' => 0, 'id' => $resultId])->count()){

                            SympathyHelper::add($resultId, $post['id']);

                        }

                    }

                    SympathyHelper::set(Yii::$app->params['users_who_like_skip_key'], $post['id'], $resultId);

                }

            }

        }

    }
    //Отправка сообщения о желающем познакомиться пользователе
    public function actionAddInvitingMessage()
    {

        $profiles = Profile::find()->where(['fake' => 1])->asArray()->with('polRelation')->all();

        foreach ($profiles as $profile){

            $city = City::find()->where(['url' => $profile['city']])->asArray()->one();

            if ($profile['polRelation']) {

                $userDialog = UserDialog::find()
                    ->where(['user_id' => $profile['id']])->select('dialog_id')
                    ->asArray()->all();

                $userDialogIds = ArrayHelper::getColumn($userDialog, 'dialog_id');

                $usersWithWhomThereIsADialogue = UserDialog::find()->select('user_id')->where(['dialog_id' => $userDialogIds])
                ->asArray()->all();

                $tmpId = ArrayHelper::getColumn($usersWithWhomThereIsADialogue, 'user_id');

                $companionProfileId  = UserPol::find()
                        ->where(['<>' , 'user_id', $profile['id']])
                        ->andWhere(['not in' , 'user_id', $tmpId])
                        ->andWhere(['city_id' => $city['id']])
                        ->andWhere(['<>', 'pol_id',$profile['polRelation']['pol_id'] ])
                        ->asArray()->all();

                if (!$fromProfile = Profile::find()->where(['in', 'id', ArrayHelper::getColumn($companionProfileId, 'user_id')])
                    ->orderBy('rand()')
                    ->asArray()
                    ->andWhere(['fake' => 1])
                    ->limit(1)
                    ->one()){
                    $fromProfile = Profile::find()->where(['in', 'id', ArrayHelper::getColumn($companionProfileId, 'user_id')])
                        ->orderBy('rand()')
                        ->asArray()
                        ->andWhere(['fake' => 0])
                        ->limit(1)
                        ->one();
                }

                $this->sendInvitingMessage($fromProfile['id'], $profile['id'], $fromProfile['username']);

            }

        }

    }

    public function sendInvitingMessage($from, $to , $name)
    {
            $model = new SendMessageForm();

            $model->from_id = $from;
            $model->created_at = \time();
            $model->user_id = $to;
            $model->text = $name . ' ' . Yii::$app->params['invitation_message_text'];
            $model->type = \frontend\modules\chat\models\Message::INVITING_MESSAGE;

            $model->save();

    }

    public function actionDeleteOldDialogs()
    {

        $messages = \frontend\modules\chat\models\Message::find()
            ->where(['<','created_at', (\time() - ( 3600 * 24 * 30))])
            ->asArray()
            ->groupBy('chat_id')
            ->limit(500)
            ->all();

        foreach ($messages as $message){

            $result = \frontend\modules\chat\models\Message::find()
                ->where(['chat_id' => $message['chat_id']])
                ->max('created_at');

            if ($result < \time() - ( 3600 * 24 * 30)){

                if ($messageWithPhoto = Message::find()
                    ->where(['chat_id' => $message['chat_id']])
                    ->andWhere(['class' => Files::class])
                    ->asArray()
                    ->all())

                {
                    foreach ($messageWithPhoto as $item){

                        $file = Files::find()->where(['id' => $item['related_id']])->asArray()->one();

                        \unlink(Yii::getAlias('@frontend').'/web'.$file['file']);

                    }
                }

            }

            \frontend\modules\chat\models\Chat::deleteAll(['id' =>  $message['chat_id']]);
            \frontend\modules\chat\models\Message::deleteAll(['chat_id' => $message['chat_id']]);
            UserDialog::deleteAll(['dialog_id' => $message['chat_id']]);


            echo $message['chat_id'];
            echo \PHP_EOL;

        }

    }

    public function actionCust()
    {
        $message = \frontend\modules\chat\models\Message::find()->where(['status' => 0, 'type' => \frontend\modules\chat\models\Message::INVITING_MESSAGE])
            ->andWhere(['<', 'created_at' , \time() - (3600 * 24 * 30)])
            ->asArray()->all();

        foreach ($message as $item){

            \frontend\modules\chat\models\Chat::deleteAll(['id' => $item['chat_id']]);
            \frontend\modules\chat\models\Message::deleteAll(['chat_id' => $item['chat_id']]);
            UserDialog::deleteAll(['dialog_id' => $item['chat_id']]);

        }

    }

}