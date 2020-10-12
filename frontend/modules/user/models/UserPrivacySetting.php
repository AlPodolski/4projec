<?php

namespace frontend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_privacy_setting".
 *
 * @property int|null $user_id
 * @property int|null $param
 */
class UserPrivacySetting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_privacy_setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'param'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'param' => 'Param',
        ];
    }
}
