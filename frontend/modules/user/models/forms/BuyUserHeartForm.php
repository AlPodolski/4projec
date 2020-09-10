<?php

namespace frontend\modules\user\models\forms;



use frontend\modules\user\models\UserHeart;
use yii\base\Model;

class BuyUserHeartForm extends Model
{
    public $buyer;
    public $userWhoHeartIsBuy;
    public $timestamp;

    public function rules()
    {
        return [
            [ ['buyer', 'userWhoHeartIsBuy', 'timestamp'], 'integer'],
            [ ['buyer', 'userWhoHeartIsBuy', 'timestamp'], 'required'],
        ];
    }

    public function save()
    {
        $model = new UserHeart();
        $model->who = $this->buyer;
        $model->whom = $this->userWhoHeartIsBuy;
        $model->timestamp = $this->timestamp;

        return $model->save();
    }

}