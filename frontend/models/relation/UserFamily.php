<?php

namespace frontend\models\relation;

use Yii;

/**
 * This is the model class for table "user_family".
 *
 * @property int|null $param_id
 * @property int|null $user_id
 * @property int|null $city_id
 */
class UserFamily extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_family';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['param_id', 'user_id'], 'integer'],
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
        ];
    }
}
