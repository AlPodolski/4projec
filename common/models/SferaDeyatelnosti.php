<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sfera_deyatelnosti".
 *
 * @property int $id
 * @property string|null $value
 * @property string|null $url
 */
class SferaDeyatelnosti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sfera_deyatelnosti';
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
