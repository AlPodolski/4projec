<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_to_metro".
 *
 * @property int|null $user_id
 * @property int|null $metro_id
 */
class UserToMetro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_to_metro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'metro_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'metro_id' => 'Metro ID',
        ];
    }
}
