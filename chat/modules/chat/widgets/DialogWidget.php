<?php
/* @var $user array*/

namespace chat\modules\chat\widgets;

use frontend\modules\chat\components\helpers\GetDialogsHelper;
use yii\base\Widget;

class DialogWidget extends Widget
{
    public $dialog_id;
    public $user;
    public $fakeUsers;
    public $recepient = false;

    public function run()
    {

        $dialog = GetDialogsHelper::getDialog($this->dialog_id);

        GetDialogsHelper::serRead($dialog['dialog_id'], $this->user['id']);

        return $this->render('dialog', [
            'dialog' => $dialog,
            'user' => $this->user,
            'fakeUsers' => $this->fakeUsers,
            'recepient' => $this->recepient,
        ]);
    }
}