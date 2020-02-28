<?php

namespace frontend\models\relation;

use Yii;

/**
 * This is the model class for table "user_intim_hair".
 *
 * @property int|null $user_id
 * @property int|null $param_id
 */
class UserIntimHair extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_intim_hair';
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
