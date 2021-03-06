<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pol".
 *
 * @property int $id
 * @property string|null $value
 */
class Pol extends \yii\db\ActiveRecord
{

    const POL_MEN = 1;
    const POL_WOMEN = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'string', 'max' => 40],
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
        ];
    }
}
