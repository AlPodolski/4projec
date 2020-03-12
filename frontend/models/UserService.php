<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_service".
 *
 * @property int|null $user_id
 * @property int|null $service_id
 * @property int|null $city_id
 */
class UserService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'service_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'service_id' => 'Service ID',
        ];
    }
}
