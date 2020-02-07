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
            [['file'], 'safe'],
        ];
    }

    public function unsetAvatarStatus(){

        Photo::updateAll(['avatar' => 0], ['user_id' => $this->user_id]);

    }

    public static function getUserPhoto($id){

        return Photo::find()->where(['user_id' => $id])->orderBy('avatar desc')->all();

    }

    public static function getAvatar($user_id)
    {
        return Photo::find()->where(['user_id' => $user_id, 'avatar' => 1])->one();
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
