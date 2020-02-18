<?php


namespace frontend\modules\user\models\forms;

use frontend\models\UserHairColor;
use frontend\models\UserService;
use frontend\models\UserSexual;
use frontend\models\UserToMetro;
use frontend\models\UserToRayon;
use yii\base\Model;
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
    public $service;
    public $sexual;
    public $rayon;
    public $metro;

    public function attributeLabels()
    {
        return [
            'hair_color' => 'Цвет волос',
            'rost' => 'Рост',
            'ves' => 'Вес',
            'eye_color' => 'Цвет глаз',
            'body' => 'Телосложение',
            'breast_size' => 'Размер груди',
            'service' => 'Сексуальные предпочтения',
            'sexual' => 'Сексуальная ориентация',
            'metro' => 'Метро',
            'rayon' => 'Район',
        ];

    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hair_color', 'rost', 'ves', 'eye_color', 'body', 'breast_size', 'sexual'], 'integer'],
            [['service', 'metro', 'rayon'], 'safe'],
        ];
    }

    public function getParams($user_id){

        $this->hair_color = ArrayHelper::getValue(UserHairColor::find()->where(['user_id'=> $user_id])->one(), 'value');
        $this->eye_color = ArrayHelper::getValue(UserEyeColor::find()->where(['user_id'=> $user_id])->one(), 'value');
        $this->rost = ArrayHelper::getValue(UserRost::find()->where(['user_id'=> $user_id])->one(), 'value');
        $this->ves = ArrayHelper::getValue(UserVes::find()->where(['user_id'=> $user_id])->one(), 'value');
        $this->body = ArrayHelper::getValue(UserBody::find()->where(['user_id'=> $user_id])->one(), 'value');
        $this->breast_size = ArrayHelper::getValue(UserBreastSize::find()->where(['user_id'=> $user_id])->one(), 'value');
        $this->service = ArrayHelper::getColumn(UserService::find()->where(['user_id'=> $user_id])->asArray()->all(), 'service_id');
        $this->metro = ArrayHelper::getColumn(UserToMetro::find()->where(['user_id'=> $user_id])->asArray()->all(), 'metro_id');
        $this->rayon = ArrayHelper::getColumn(UserToRayon::find()->where(['user_id'=> $user_id])->asArray()->all(), 'rayon_id');
        $this->sexual = ArrayHelper::getValue(UserSexual::find()->where(['user_id'=> $user_id])->asArray()->one(), 'sexual_id');
    }

    public function save($user_id){

        if ($this->hair_color) $this->saveHairColor($user_id);
        if ($this->eye_color) $this->saveEyeColor($user_id);
        if ($this->body) $this->saveUserBody($user_id);
        if ($this->breast_size) $this->saveUserBreast($user_id);
        if ($this->rost) $this->saveUserRost($user_id);
        if ($this->ves) $this->saveUserVes($user_id);
        if ($this->service) $this->saveService($user_id);
        if ($this->sexual) $this->saveSexual($user_id);
        if ($this->metro) $this->saveMetro($user_id);
        if ($this->rayon) $this->saveRayon($user_id);

        return true;

    }

    public function saveSexual($id){

        UserSexual::deleteAll('user_id = '.$id);

        $user_to_service = new UserSexual();

        $user_to_service->user_id = $id;

        $user_to_service->sexual_id = $this->sexual;

        $user_to_service->save();

    }
    public function saveService($id){

        UserService::deleteAll('user_id = '.$id);

        foreach ($this->service  as $item){

            $user_to_service = new UserService();

            $user_to_service->user_id = $id;

            $user_to_service->service_id = $item;

            $user_to_service->save();

        }

    }

    public function saveMetro($id){

        UserToMetro::deleteAll('user_id = '.$id);

        foreach ($this->metro  as $item){

            $user_to_metro = new UserToMetro();

            $user_to_metro->user_id = $id;

            $user_to_metro->metro_id = $item;

            $user_to_metro->save();

        }

    }

    public function saveRayon($id){

        UserToRayon::deleteAll('user_id = '.$id);

        foreach ($this->rayon  as $item){

            $user_to_rayon = new UserToRayon();

            $user_to_rayon->user_id = $id;

            $user_to_rayon->rayon_id = $item;

            $user_to_rayon->save();

        }

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