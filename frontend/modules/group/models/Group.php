<?php

namespace frontend\modules\group\models;

use frontend\models\Files;
use frontend\modules\user\models\Profile;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string|null $name Название группы
 * @property int|null $user_id id владельца группы
 * @property int|null $vk_url урл группы вк
 * @property int|null $category категория к которой относится группа
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'user_id' => 'User ID',
        ];
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['id' => 'user_id'])->with('userAvatarRelations');
    }

    public function getAvatar()
    {
        return $this->hasOne(Files::class, ['related_id' => 'id' ])
            ->where(['main' => 1, 'related_class' => Group::class]);
    }

}
