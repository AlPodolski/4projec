<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_zhigalo".
 *
 * @property int|null $user_id
 * @property int|null $param_id
 */
class UserZhigalo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_zhigalo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'param_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'param_id' => 'Param ID',
        ];
    }
}
