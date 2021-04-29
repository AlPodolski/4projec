<?php


namespace frontend\modules\chat\models\forms;

use frontend\models\Files;
use frontend\modules\chat\models\Message;
use frontend\modules\chat\models\Chat;
use frontend\modules\chat\models\relation\UserDialog;
use yii\base\Model;

class SendPhotoForm extends Model
{
    public $photo;
    public $user_id;
    public $dialog_id;
    public $photo_id;
    public $to;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'dialog_id'], 'integer'],
            [['file' , 'to'], 'safe'],
        ];
    }

    public function save()
    {

        if ($this->dialog_id){

            $message = new Message();

            $message->from = $this->user_id;
            $message->created_at = \time();
            $message->chat_id = $this->dialog_id;
            $message->status = 0;
            $message->class = Files::class;
            $message->related_id = $this->photo_id;

            if ($message->save()) return $message;

        }else{

            $dialog = new Chat();
            $dialog->timestamp = \time();

            $dialog->save();

            $userDialog = new UserDialog();
            $userDialog->user_id = $this->user_id;
            $userDialog->dialog_id = $dialog->id;

            $userDialog->save();

            $userDialog = new UserDialog();
            $userDialog->user_id = $this->to;
            $userDialog->dialog_id = $dialog->id;

            $userDialog->save();

            $message = new Message();

            $message->from = $this->user_id;
            $message->created_at = \time();
            $message->chat_id = $dialog->id;
            $message->status = 0;
            $message->class = Files::class;
            $message->related_id = $this->photo_id;

            if ($message->save()) return $message;

        }

    }

}