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

        $size = \sizeof($dialogs);

        for ($i = $size; $i>=0; $i--) {

            for ($j = 0; $j<=($i-1); $j++)

                if ($dialogs[$j]['lastMessage']['status'] > $dialogs[$j+1]['lastMessage']['status']) {

                    $k = $dialogs[$j];

                    $dialogs[$j] = $dialogs[$j+1];

                    $dialogs[$j+1] = $k;
                }
        }

        return $this->render('dialog_list', [
            'dialogs' => $dialogs,
            'user_id' => $this->user_id,
        ]);
    }
}