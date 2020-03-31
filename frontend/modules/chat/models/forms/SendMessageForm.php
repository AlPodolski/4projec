<?php

namespace frontend\modules\chat\models\forms;

use frontend\modules\chat\models\Message;
use yii\base\Model;

class SendMessageForm extends Model
{
    public $text;
    public $from_id;
    public $chat_id;
    public $created_at;


    public function rules()
    {
        return [
            [['text', 'from_id', 'chat_id'], 'required'],
            [['from_id', 'chat_id'], 'integer'],
            [['text'], 'string'],
        ];
    }

    public function save(){

        $message = new Message();

        $message->message = $this->text;
        $message->from = $this->from_id;
        $message->created_at = $this->created_at;
        $message->chat_id = $this->chat_id;
        $message->status = 0;

        return $message->save();

    }
}