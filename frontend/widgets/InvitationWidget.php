<?php


namespace frontend\widgets;

use yii\base\Widget;

class InvitationWidget extends Widget
{

    public $img;

    public $message;

    public $name;

    public function run()
    {
        return $this->render('invitation-form' , [
            'img' => $this->img,
            'message' => $this->message,
            'name' => $this->name,
        ]);
    }
}