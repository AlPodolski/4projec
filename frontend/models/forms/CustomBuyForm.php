<?php


namespace frontend\models\forms;
use yii\base\Model;

class CustomBuyForm extends Model
{
    public $user_id;
    public $sum;

    public function rules()
    {
        return [
            [['user_id', 'sum'], 'required'],
            [['user_id', 'sum'], 'integer'],
        ];
    }
}