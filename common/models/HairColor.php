<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hair_color".
 *
 * @property int $id
 * @property string|null $value
 * @property int|null $pol
 */
class HairColor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hair_color';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pol'], 'integer'],
            [['value'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'pol' => 'Pol',
        ];
    }
}
