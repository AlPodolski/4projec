<?php


namespace frontend\modules\user\models;

use yii\redis\ActiveRecord;

/**
 * This is the model class for table "photo".
 *
 * @property int $id
 * @property int|null $user_id ид того чьи друзья
 * @property int|null $friend_user_id ид того кто в друзьях
 */

class Friends extends ActiveRecord
{
    /**
     * @return array the list of attributes for this record
     */
    public function attributes()
    {
        return ['id', 'user_id', 'friend_user_id'];
    }

    public function getProfiles()
    {
        return $this->hasMany(Profile::class, ['id' => 'user_id']);
    }
}