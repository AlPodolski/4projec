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

        //сортировка по новизне
        for ($i = $size; $i>=0; $i--) {

            for ($j = 0; $j<=($i-1); $j++)

                if ($dialogs[$j]['lastMessage']['status'] > $dialogs[$j+1]['lastMessage']['status']) {

                    $k = $dialogs[$j];

                    $dialogs[$j] = $dialogs[$j+1];

                    $dialogs[$j+1] = $k;
                }

        }

        foreach ($dialogs as $key => $value){

            if ($value){

                if (\in_array($value['lastMessage']['from'], $this->user_id ) ){

                    unset($dialogs[$key]);

                    \array_push($dialogs, $value);

                }

            }

        }

        return $this->render('dialog_list', [
            'dialogs' => $dialogs,
            'user_id' => $this->user_id,
        ]);
    }
}