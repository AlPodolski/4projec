<?php


namespace frontend\modules\chat\widgets;

use yii\base\Widget;

class MessageListWidget extends Widget
{

    public $user_id;

    public function init(){

    }

    public function run()
    {
        return $this->render('dialog_list');
    }
}