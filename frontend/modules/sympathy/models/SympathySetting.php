<?php

namespace frontend\modules\sympathy\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "sympathy_setting".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $pol_id ид пола который ищет пользователь
 * @property int|null $age_from с какого возраста  ищет пользователь
 * @property int|null $age_to до какого возраста ищет пользователь
 *
 * @property User $user
 */
class SympathySetting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sympathy_setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'pol_id', 'age_from', 'age_to'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'pol_id' => 'Пол',
            'age_from' => 'Age From',
            'age_to' => 'Age To',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
