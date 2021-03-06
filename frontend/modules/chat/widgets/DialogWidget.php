<?php
/* @var $user array*/

namespace frontend\modules\chat\widgets;

use frontend\modules\chat\components\helpers\GetDialogsHelper;
use yii\base\Widget;

class DialogWidget extends Widget
{
    public $dialog_id;
    public $user;
    public $recepient = false;
    public $userTo;
    public $limitExist;

    public function init(){

    }

    public function run()
    {

        $dialog = GetDialogsHelper::getDialog($this->dialog_id);

        GetDialogsHelper::serRead($dialog['dialog_id'], $this->user['id']);

        return $this->render('dialog', [
            'dialog' => $dialog,
            'dialog_id' => $dialog['dialog_id'],
            'user' => $this->user,
            'userTo' => $this->userTo,
            'recepient' => $this->recepient,
            'limitExist' => $this->limitExist,
        ]);
    }
}