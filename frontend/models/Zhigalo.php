<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "zhigalo".
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $value
 */
class Zhigalo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zhigalo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'value'], 'string', 'max' => 50],
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
        ];
    }
}
