<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_national".
 *
 * @property int|null $user_id
 * @property int|null $national_id
 */
class UserNational extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_national';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'national_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'national_id' => 'National ID',
        ];
    }
}
