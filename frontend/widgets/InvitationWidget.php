<?php


namespace frontend\widgets;

use yii\base\Widget;

class InvitationWidget extends Widget
{

    public $img;
    public $message;
    public $name;
    public $post_id;

    public function run()
    {
        return $this->render('invitation-form' , [
            'img' => $this->img,
            'message' => $this->message,
            'name' => $this->name,
            'post_id' => $this->post_id,
        ]);
    }
}