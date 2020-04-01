<?php


namespace frontend\modules\chat\widgets;

use frontend\modules\chat\components\helpers\GetDialogsHelper;
use frontend\modules\chat\models\forms\SendMessageForm;
use yii\base\Widget;

class SendMessageFormWidget extends Widget
{

    public function init(){

    }

    public function run()
    {

        $model = new SendMessageForm();

        return $this->render('send_message_form.php', [
            'model' => $model,
        ]);
    }
}