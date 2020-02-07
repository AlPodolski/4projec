<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_params".
 *
 * @property int|null $param_id
 * @property int|null $user_id
 * @property string|null $value
 */
class UserParams extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_params';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['param_id', 'user_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'param_id' => 'Param ID',
            'user_id' => 'User ID',
            'value' => 'Value',
        ];
    }
}
