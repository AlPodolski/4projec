<?php


namespace console\controllers;

use chat\modules\chat\models\Message;
use frontend\modules\chat\components\helpers\GetDialogsHelper;
use frontend\modules\chat\models\relation\UserDialog;
use yii\console\Controller;
use common\models\BlackList;
use yii\helpers\ArrayHelper;

class AnswerController extends Controller
{
    public function actionWriteAnswer()
    {
        $messages = Message::find()->where(['status' => 0])->andWhere(['<', 'created_at', (\time() - 3600 * 26)])->select('chat_id , from, message ,id')->asArray()->all();

        $blackList = ArrayHelper::getColumn(BlackList::find()->asArray()->all(), 'user_id');

        $blackListLocal = array();

        foreach ($messages as $message){

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