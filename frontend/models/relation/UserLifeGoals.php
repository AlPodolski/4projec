<?php

namespace frontend\models\relation;

use Yii;

/**
 * This is the model class for table "user_life_goals".
 *
 * @property int|null $user_id
 * @property int|null $param_id
 * @property int|null $city_id
 */
class UserLifeGoals extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_life_goals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'param_id', 'city_id'], 'integer'],
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
