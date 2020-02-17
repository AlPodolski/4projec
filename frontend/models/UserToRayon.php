<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_to_rayon".
 *
 * @property int|null $user_id
 * @property int|null $rayon_id
 */
class UserToRayon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_to_rayon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'rayon_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'rayon_id' => 'Rayon ID',
        ];
    }
}
