<?php
/* @var $user array*/

namespace frontend\modules\chat\widgets;

use frontend\modules\chat\components\helpers\GetDialogsHelper;
use yii\base\Widget;

class DialogWidget extends Widget
{
    public $dialog_id;
    public $user;

    public function init(){

    }

    public function run()
    {

        $dialog = GetDialogsHelper::getDialog($this->dialog_id);

        return $this->render('dialog', [
            'dialog' => $dialog,
            'user' => $this->user,
        ]);
    }
}