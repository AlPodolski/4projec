<?php


namespace frontend\modules\user\models\forms;

use common\models\FilterParams;
use frontend\modules\user\components\helpers\SaveAnketInfoHelper;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use Yii;

class Params extends Model
{
    public $hairColor;
    public $eyeColor;
    public $rost;
    public $userVes;
    public $body;
    public $breastSize;
    public $service;
    public $sexual;
    public $rayon;
    public $metro;

    public $place;
    public $national;
    public $financialSituation;
    public $interesting;
    public $professionals;
    public $vneshnost;
    public $vajnoeVPartnere;
    public $children;
    public $family;
    public $wantFind;
    public $celiZnakomstvamstva;
    public $haracter;
    public $lifeGoals;
    public $smoking;
    public $alcogol;
    public $education;
    public $breast;
    public $intimHair;
    public $sferaDeyatelnosti;
    public $zhile;
    public $transport;

    public function attributeLabels()
    {
        return [
            'hairColor' => 'Цвет волос',
            'rost' => 'Рост',
            'userVes' => 'Вес',
            'eyeColor' => 'Цвет глаз',
            'body' => 'Телосложение',
            'breast_size' => 'Размер груди',
            'service' => 'Сексуальные предпочтения',
            'sexual' => 'Сексуальная ориентация',
            'metro' => 'Метро',
            'rayon' => 'Район',
        ];

    }

    private $must_be_array = ['service', 'metro', 'rayon'];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hairColor', 'rost', 'userVes', 'eyeColor', 'body', 'breastSize', 'sexual'], 'integer'],
            [['service', 'metro', 'rayon'], 'safe'],
        ];
    }

    public function getParams($user_id){

        $filterParams = FilterParams::find()->asArray()->all();

        foreach ($this as $key => $value){

            foreach ($filterParams as $filterParam){

                if (\strtolower($filterParam['short_name']) == \strtolower($key)){

                    if (\in_array($key, $this->must_be_array)){

                        $this->$key = ArrayHelper::getColumn($filterParam['relation_class']::find()->where(['user_id'=> $user_id])->all(), $filterParam['column_param_name']);

                    }else{

                        $this->$key = ArrayHelper::getValue($filterParam['relation_class']::find()->where(['user_id'=> $user_id])->one(), $filterParam['column_param_name']);

                    }

                }

            }

        }

    }

    public function save($user_id){

        $filterParams = FilterParams::find()->asArray()->all();

        foreach ($this as $key => $value){

            foreach ($filterParams as $filterParam){

                if (\strtolower($filterParam['short_name']) == \strtolower($key)){

                    $transaction = Yii::$app->db->beginTransaction();

                    if ($filterParam['relation_class']::deleteAll('user_id = '.$user_id)
                        and SaveAnketInfoHelper::save($value, $user_id, $filterParam['relation_class'], $filterParam['column_param_name'])){

                        $transaction->commit();

                    }
                    else $transaction->rollBack();
                }

            }

        }

        return true;

    }

}