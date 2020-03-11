<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transport".
 *
 * @property int $id
 * @property string|null $value
 * @property string|null $url
 */
class Transport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transport';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value', 'url'], 'string', 'max' => 50],
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
            'url' => 'Url',
        ];
    }
}
