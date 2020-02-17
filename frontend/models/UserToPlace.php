<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_to_place".
 *
 * @property int|null $user_id
 * @property int|null $place_id
 */
class UserToPlace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_to_place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'place_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'place_id' => 'Place ID',
        ];
    }
}
