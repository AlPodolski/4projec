<?php


namespace frontend\deamon;

use common\models\Presents;
use common\models\User;
use consik\yii2websocket\events\WSClientEvent;
use consik\yii2websocket\WebSocketServer;
use frontend\components\helpers\CheckVipDialogHelper;
use frontend\components\helpers\VipHelper;
use frontend\models\relation\UserPresents;
use frontend\modules\chat\components\helpers\GetDialogsHelper;
use frontend\modules\chat\models\forms\SendMessageForm;
use Ratchet\ConnectionInterface;
use Yii;


class EchoServer extends WebSocketServer
{
    public function init()
    {
        parent::init();

        $this->on(self::EVENT_CLIENT_CONNECTED, function(WSClientEvent $e) {
            $e->client->name = null;
            $e->client->udata = $this->getData($e->client);
        });
    }


    protected function getCommand(ConnectionInterface $from, $msg)
    {
        $request = json_decode($msg, true);
        return !empty($request['action']) ? $request['action'] : parent::getCommand($from, $msg);
    }

    public function commandSetRead(ConnectionInterface $client, $msg)
    {

        $request = json_decode($msg, true);

        GetDialogsHelper::serRead($request['dialog_id'], $client->udata['id']);

    }

    /**
     * Отправка сообщения о подарке
     * @param ConnectionInterface $client
     * @param $msg
     */
    public function commandSendPresent(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);

        if ($present = UserPresents::find()->where(['id' => $request['present_id']])->with('present')->asArray()->one()){

            foreach ($this->clients as $chatClient) {

                if (isset( $chatClient->udata['id'])){
                    if ($chatClient->udata['id'] == $present['from'] or $chatClient->udata['id'] == $present['to']){
                        $chatClient->send( json_encode([
                            'type' => 'send_present',
                            'from' => $present['from'],
                            'to' => $present['to'],
                            'img' => $present['present']['img'],
                            'message' => $present['message']
                        ]) );
                    }
                }

            }

        }

        $client->close();

    }

    public function commandChat(ConnectionInterface $client, $msg)
    {

        $request = json_decode($msg, true);
        $result = ['message' => ''];

        if (!VipHelper::checkVip($client->udata['vip_status_work'])){

            if ($request['dialog_id'] == ''){

                if (!CheckVipDialogHelper::checkLimitDialog($client->udata['id'], Yii::$app->params['dialog_day_limit'])) return 'Превышен лимит диалогов';

            }else{

                if (!CheckVipDialogHelper::checkExistDialogId($client->udata['id'], $request['dialog_id']) and
                    !CheckVipDialogHelper::checkLimitDialog($client->udata['id'], Yii::$app->params['dialog_day_limit'])
                ) return 'Превышен лимит диалогов';

            }

        }

        if ($dialogid = $this->save_message($client->udata['id'], $request['message'], $request['to'], $request['dialog_id'])) {

            if (!CheckVipDialogHelper::checkExistDialogId($client->udata['id'], $dialogid)) {
                CheckVipDialogHelper::addDialogIdToDay($client->udata['id'], $dialogid);
            }

            foreach ($this->clients as $chatClient) {
                if ($chatClient->udata['id'] == $request['to']){
                    $chatClient->send( json_encode([
                        'type' => 'chat',
                        'from' => $client->udata['name'],
                        'from_id' => $client->udata['id'],
                        'message' => $request['message']
                    ]) );
                }
            }
        } else {
            $result['message'] = 'Enter message';
        }

        $client->send( json_encode($result) );
    }

    public function commandChatAdmin(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);
        $result = ['message' => ''];

        if ($this->save_message($request['from_id'], $request['message'], $request['to'], $request['dialog_id'])
            && $message = trim($request['message']) ) {
            foreach ($this->clients as $chatClient) {
                if ($chatClient->udata['id'] == $request['to']){
                    $chatClient->send( json_encode([
                        'type' => 'chat',
                        'from' => $request['from_name'],
                        'from_id' => $request['from_id'],
                        'message' => $message
                    ]) );
                }
            }
        }
    }

    public function commandAdminWriteAnswerStart(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);

        if ($request['from'] > 0 and $request['to'] > 0){

            foreach ($this->clients as $chatClient) {
                if ($chatClient->udata['id'] == $request['to']){
                    $chatClient->send( json_encode([
                        'type' => 'writeAnswer',
                        'from' => $request['from'],
                    ]));
                }
            }
        }
    }

    public function commandAdminStopWriteAnswerStart(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);

        if ($request['from'] > 0 and $request['to'] > 0){

            foreach ($this->clients as $chatClient) {
                if ($chatClient->udata['id'] == $request['to']){
                    $chatClient->send( json_encode([
                        'type' => 'stopWriteAnswer',
                        'from' => $request['from'],
                    ]));
                }
            }
        }
    }

    public function getData($connect)
    {

        if ($connect->WebSocket->request->getCookies() and $data = \urldecode($connect->WebSocket->request->getCookies()['_identity-frontend'])){

            $data = Yii::$app->getSecurity()->validateData($data, Yii::$app->params['coockie_front']);

            if (defined('PHP_VERSION_ID') && PHP_VERSION_ID >= 70000) {

                $data = @unserialize($data, ['allowed_classes' => false]);

            } else {

                $data = @unserialize($data);

            }

            if (\is_array( $data)){

                $data = \json_decode($data[1]);

                if ($user = $this->checkUser($data[0], $data[1])){
                    return array('id' => $user['id'], 'name' => $user['username'], 'vip_status_work' => $user['vip_status_work']);
                }

            }

        }

        return false;
    }

    public function checkUser($id, $auth_key)
    {
        return User::find()->where(['id' => $id, 'auth_key' => $auth_key])->asArray()->one();
    }

    public function save_message( $from,  $text ,  $to , $chat_id = null )
    {

        $model = new SendMessageForm();

        $model->from_id = $from;
        $model->created_at = \time();
        $model->text = $text;
        $model->user_id = $to;
        $model->chat_id = $chat_id;


        if ($model->validate() ){

            return $model->save();

        }

        return false;
    }

}