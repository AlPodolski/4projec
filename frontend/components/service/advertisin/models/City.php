<?php

namespace frontend\components\service\advertisin\models;

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
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
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
