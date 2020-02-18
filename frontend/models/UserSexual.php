<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_sexual".
 *
 * @property int|null $user_id
 * @property int|null $sexual_id
 */
class UserSexual extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_sexual';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'sexual_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'sexual_id' => 'Sexual ID',
        ];
    }
}
