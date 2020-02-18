<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_pol".
 *
 * @property int|null $user_id
 * @property int|null $pol_id
 */
class UserPol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_pol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'pol_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'pol_id' => 'Pol ID',
        ];
    }
}
