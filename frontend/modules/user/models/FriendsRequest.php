<?php


namespace frontend\modules\user\models;

use yii\redis\ActiveRecord;

/**
 * This is the model class for table "photo".
 *
 * @property int $id
 * @property int|null $user_id // ид к кому запрос в друзья
 * @property int|null request_user_id // ид того кто дает запрос в друзья
 */
class FriendsRequest extends ActiveRecord
{
    /**
     * @return array the list of attributes for this record
     */
    public function attributes()
    {
        return ['id', 'user_id', 'request_user_id'];
    }

    public function getFriendsProfiles()
    {
        return $this->hasMany(Profile::class, ['id' => 'user_id']);
    }
}