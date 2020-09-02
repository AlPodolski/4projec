<?php


namespace chat\modules\chat\widgets;

use chat\modules\chat\components\helpers\GetDialogsHelper;
use yii\base\Widget;

class MessageListWidget extends Widget
{

    public $user_id;

    public function init(){

    }

    public function run()
    {

        $dialogs = GetDialogsHelper::getDialogs($this->user_id);

        foreach ($dialogs as &$dialog){
            if ($dialog['lastMessage']['status'] > 0) unset($dialog);
        }

        return $this->render('dialog_list', [
            'dialogs' => $dialogs,
            'user_id' => $this->user_id,
        ]);
    }
}