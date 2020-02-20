<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property string|null $value
 * @property string|null $url
 * @property string|null $category
 * @property integer|null $pol
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value', 'url', 'category'], 'string', 'max' => 50],
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
            'category' => 'Category',
        ];
    }
}
