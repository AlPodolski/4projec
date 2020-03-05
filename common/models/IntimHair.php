<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "intim_hair".
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $value
 */
class IntimHair extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'intim_hair';
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