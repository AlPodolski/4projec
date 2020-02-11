<?php


namespace frontend\modules\user\models\forms;

use frontend\models\UserHairColor;
use yii\base\Model;
use frontend\models\UserParams;
use frontend\models\UserEyeColor;
use frontend\models\UserBody;
use frontend\models\UserBreastSize;
use frontend\models\UserVes;
use frontend\models\UserRost;
use yii\helpers\ArrayHelper;

class Params extends Model
{
    public $hair_color;
    public $eye_color;
    public $rost;
    public $ves;
    public $body;
    public $breast_size;

    public function attributeLabels()
    {
        return [
            'hair_color' => 'Цвет волос',
            'rost' => 'Рост',
            'ves' => 'Вес',
            'eye_color' => 'Цвет глаз',
            'body' => 'Телосложение',
            'breast_size' => 'Размер груди',
        ];

    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hair_color', 'rost', 'ves', 'eye_color', 'body', 'breast_size'], 'integer'],
        ];
    }

    public function getParams($user_id){

        $this->hair_color = ArrayHelper::getValue(UserHairColor::find()->where(['user_id'=> $user_id])->one(), 'value');
        $this->eye_color = ArrayHelper::getValue(UserEyeColor::find()->where(['user_id'=> $user_id])->one(), 'value');
        $this->rost = ArrayHelper::getValue(UserRost::find()->where(['user_id'=> $user_id])->one(), 'value');
        $this->ves = ArrayHelper::getValue(UserVes::find()->where(['user_id'=> $user_id])->one(), 'value');
        $this->body = ArrayHelper::getValue(UserBody::find()->where(['user_id'=> $user_id])->one(), 'value');
        $this->breast_size = ArrayHelper::getValue(UserBody::find()->where(['user_id'=> $user_id])->one(), 'value');

    }

    public function save($user_id){

        if ($this->hair_color) $this->saveHairColor($user_id);
        if ($this->eye_color) $this->saveEyeColor($user_id);
        if ($this->body) $this->saveUserBody($user_id);
        if ($this->breast_size) $this->saveUserBreast($user_id);
        if ($this->rost) $this->saveUserRost($user_id);
        if ($this->ves) $this->saveUserVes($user_id);

        return true;

    }

    private function saveUserVes($user_id){

        $user_hair = new UserVes();

        $user_hair->user_id = $user_id;
        $user_hair->value = $this->ves;

        $user_hair->save();

    }

    private function saveUserRost($user_id){

        $user_hair = new UserRost();

        $user_hair->user_id = $user_id;
        $user_hair->value = $this->rost;

        $user_hair->save();

    }

    private function saveUserBreast($user_id){

        $user_hair = new UserBreastSize();

        $user_hair->user_id = $user_id;
        $user_hair->value = $this->breast_size;

        $user_hair->save();

    }

    private function saveUserBody($user_id){

        $user_hair = new UserBody();

        $user_hair->user_id = $user_id;
        $user_hair->value = $this->body;

        $user_hair->save();

    }

    private function saveEyeColor($user_id){

        $user_hair = new UserEyeColor();

        $user_hair->user_id = $user_id;
        $user_hair->value = $this->eye_color;

        $user_hair->save();

    }

    private function saveHairColor($user_id){

        $user_hair = new UserHairColor();

        $user_hair->user_id = $user_id;
        $user_hair->value = $this->hair_color;

        $user_hair->save();

    }

}