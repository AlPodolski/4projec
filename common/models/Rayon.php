<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rayon".
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $value
 * @property string|null $city
 */
class Rayon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rayon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'value', 'city'], 'string', 'max' => 50],
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
            'value' => 'Value',
            'city' => 'City',
        ];
    }
}
