<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $city
 * @property string|null $city2
 * @property string|null $city3
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'city', 'city2', 'city3'], 'string', 'max' => 50],
        ];
    }

    public static function getCity($city){

        $result = Yii::$app->cache->get('4dosug_city_'.$city);

        if ($result === false) {
            // $data нет в кэше, вычисляем заново
            $result = City::find()->where(['url' => $city])->orWhere(['city' => $city])->asArray()->one();
            // Сохраняем значение $data в кэше. Данные можно получить в следующий раз.
            Yii::$app->cache->set('4dosug_city_'.$city , $result);
        }

        return $result;

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'city' => 'City',
            'city2' => 'City2',
            'city3' => 'City3',
        ];
    }
}
