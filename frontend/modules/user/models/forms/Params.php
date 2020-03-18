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
            'place' => 'Место встречи',
            'national' => 'Начиональность',
            'financialSituation' => 'Финансовое положение',
            'interesting' => 'Интересы',
            'professionals' => 'Профессия',
            'vneshnost' => 'Внешность',
            'vajnoeVPartnere' => 'Важное в партнере',
            'children' => 'Дети',
            'family' => 'Семья',
            'wantFind' => 'Хочу найти',
            'celiZnakomstvamstva' => 'Цели знакомства',
            'haracter' => 'Характер',
            'lifeGoals' => 'Жизненые приоритеты',
            'smoking' => 'Отношение к курению',
            'alcogol' => 'Отношение к алкоголю',
            'education' => 'Образование',
            'breast' => 'Размер груди',
            'intimHair' => 'Интимная стрижка',
            'sferaDeyatelnosti' => 'Сфера деятельности',
            'zhile' => 'Жилье',
            'transport' => 'Транспорт',
        ];

    }

    private $must_be_array = ['service', 'metro', 'rayon', 'place', 'interesting', 'vajnoeVPartnere', 'celiZnakomstvamstva', 'lifeGoals', 'wantFind', 'haracter'];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hairColor', 'rost', 'userVes', 'eyeColor', 'body', 'breastSize', 'sexual','national',
            'financialSituation', 'professionals', 'vneshnost', 'children', 'family', 'wantFind', 'haracter',
                'smoking', 'alcogol', 'education', 'breast', 'intimHair', 'sferaDeyatelnosti', 'zhile', 'transport'
            ], 'integer'],
            [['service', 'metro', 'rayon', 'place', 'interesting', 'vajnoeVPartnere', 'celiZnakomstvamstva', 'lifeGoals'], 'safe'],
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

                    $filterParam['relation_class']::deleteAll('user_id = '.$user_id);

                    SaveAnketInfoHelper::save($value, $user_id, $filterParam['relation_class'], $filterParam['column_param_name']);

                }

            }

        }

        return true;

    }

}