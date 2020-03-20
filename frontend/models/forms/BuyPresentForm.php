<?php


namespace frontend\models\forms;

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

    }
}