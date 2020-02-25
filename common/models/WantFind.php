<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "want_find".
 *
 * @property int $id
 * @property string|null $value
 * @property string|null $url
 * @property int|null $pol
 */
class WantFind extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'want_find';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pol'], 'integer'],
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
            'pol' => 'Pol',
        ];
    }
}
