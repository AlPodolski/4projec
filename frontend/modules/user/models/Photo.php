<?php

namespace frontend\modules\user\models;

use Yii;

/**
 * This is the model class for table "photo".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $file
 * @property int|null $avatar
 */
class Photo extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'avatar'], 'integer'],
            [['file'], 'string', 'max' => 50],
        ];
    }

    public static function addNewAvatar($user_id, $avatar){



    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'file' => 'Добавить фото',
            'avatar' => 'Avatar',
        ];
    }
}
