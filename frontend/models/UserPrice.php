<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_price".
 *
 * @property int|null $price_id
 * @property int|null $user_id
 * @property string|null $value
 */
class UserPrice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price_id', 'user_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'price_id' => 'Price ID',
            'user_id' => 'User ID',
            'value' => 'Value',
        ];
    }
}
