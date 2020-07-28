<?php

namespace frontend\modules\group\models\relation;

use frontend\modules\group\models\Group;
use Yii;

/**
 * This is the model class for table "user_group".
 *
 * @property int|null $user_id ид подписчика
 * @property int|null $group_id ид группы на которую подписан пользователь
 */
class UserGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'group_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'group_id' => 'Group ID',
        ];
    }

    public function getGroup()
    {
        return $this->hasOne(Group::class, ['id' => 'group_id']);
    }

}
