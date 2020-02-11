<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_rost".
 *
 * @property int|null $user_id
 * @property int|null $value
 */
class UserRost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_rost';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'value'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'value' => 'Value',
        ];
    }

    public function beforeSave($insert)
    {
        self::deleteAll('user_id = ' . $this->user_id);

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
