<?php


namespace frontend\modules\user\models\forms;

use yii\base\Model;

class PayForm extends Model
{
    public $sum;

    public function attributeLabels()
    {
        return [
            'sum' => 'Сумма',
        ];
    }

    public function rules()
    {
        return [
            ['sum', 'integer']
        ];
    }

}