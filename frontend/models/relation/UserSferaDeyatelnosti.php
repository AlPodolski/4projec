<?php

namespace frontend\models\relation;

use Yii;

/**
 * This is the model class for table "user_sfera_deyatelnosti".
 *
 * @property int|null $user_id
 * @property int|null $param_id
 * @property int|null $city_id
 */
class UserSferaDeyatelnosti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_sfera_deyatelnosti';
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
            'city_id' => 'City ID',
        ];
    }
}
