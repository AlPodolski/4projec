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
 * @property int|null $status
 */
class Photo extends \yii\db\ActiveRecord
{

    const STATUS_DEFAULT = 0;
    const STATUS_HIDE = 1;

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
            [['user_id', 'avatar', 'status'], 'integer'],
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
        $photo = Yii::$app->cache->get('avatar_'.$user_id);

        if ($photo === false){

            $photo = Photo::find()->where(['user_id' => $user_id, 'avatar' => 1])->one();

            Yii::$app->cache->set('avatar_'.$user_id, $photo, 60);

        }

        return $photo;
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
