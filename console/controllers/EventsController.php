<?php


namespace console\controllers;

use frontend\modules\chat\models\Message;
use Yii;
use yii\console\Controller;

class EventsController extends Controller
{
    public function actionIndex()
    {

        $emails = array();

        $from_time = \time() - 3600;

        $to_time = \time() - 1800;

        $user_ids = Message::find()->where(['status' => 0])->andWhere([ '>', 'created_at' , $from_time])
            ->andWhere(['<', 'created_at' , $to_time])->groupBy('chat_id')->with('dialog')->all();

        foreach ($user_ids as $user_id){

            if (isset($user_id['dialog']['authorNoPhoto']['email']) and $user_id['dialog']['authorNoPhoto']['email']
                and !\in_array( $user_id['dialog']['authorNoPhoto']['email'], $emails)){

                $emails[] = $user_id['dialog']['authorNoPhoto']['email'];

                Yii::$app
                    ->mailer
                    ->compose()
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' '])
                    ->setTo($user_id['dialog']['authorNoPhoto']['email'])
                    ->setSubject('Новое сообщений ' . Yii::$app->name)
                    ->setHtmlBody('Здравствуйте '.$user_id['dialog']['authorNoPhoto']['username'].' , у Вас новое сообщение '
                        .' <a href="https://'.$user_id['dialog']['authorNoPhoto']['city'].'.'.Yii::$app->params['site_name'].'/user/chat">На сайте '. Yii::$app->name.'</a>')
                    ->setTextBody('Здравствуйте '.$user_id['dialog']['authorNoPhoto']['username'].' , у Вас новое сообщение '
                        .' На сайте '. Yii::$app->name.'')
                    ->send();

            }

        }
    }
}