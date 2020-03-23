<?php


namespace frontend\models\forms;

use frontend\models\relation\UserPresents;
use yii\base\Model;

class BuyPresentForm extends Model
{
    public $present_id;
    public $from_id;
    public $to_id;


    public function rules()
    {
        return [
            [['present_id', 'from_id', 'to_id'], 'required'],
            [['present_id', 'from_id', 'to_id'], 'integer'],
        ];
    }

    public function save(){

        $userPresent = new UserPresents();

        $userPresent->resent_id = $this->present_id;
        $userPresent->from = $this->from_id;
        $userPresent->to = $this->to_id;
        $userPresent->timestamp = \time();

        return $userPresent->save();

    }
}