<?php

namespace frontend\models;

use frontend\modules\user\models\Profile;
use Yii;

/**
 * This is the model class for table "user_pol".
 *
 * @property int|null $user_id
 * @property int|null $pol_id
 * @property int|null $city_id
 */
class UserPol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_pol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'pol_id', 'city_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'pol_id' => 'Pol ID',
        ];
    }

    public function getPost(){
        return $this->hasOne(Profile::class, ['id' => 'user_id' ])->with('avatar');
    }

    public function getProfile(){
        return $this->hasOne(Profile::class, ['id' => 'user_id' ]);
    }


}
