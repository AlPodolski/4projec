<?php

namespace frontend\modules\user\models;

use common\models\Params;
use common\models\Service;
use frontend\models\UserParams;
use frontend\models\UserService;
use Yii;
use yii\db\ActiveRecord;
use frontend\models\UserPrice;
/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 * @property string|null $city
 * @property string|null $text
 * @property string|null $birthday
 */
class Profile extends \yii\db\ActiveRecord
{

    public $avatar;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token', 'city'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'city' => 'City',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserServiceRelations()
    {
        return $this->hasMany(UserService::className(), ['user_id' => 'id']);
    }

    /**
     * @return array|ActiveRecord[]
     */
    public function getService()
    {
        return $this->hasMany(Service::className(), ['id' => 'service_id'])->via('userServiceRelations')->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserParamRelations()
    {
        return $this->hasMany(UserParams::class, ['user_id' => 'id']);
    }

    /**
     * @return array|ActiveRecord[]
     */
    public function getParams()
    {
        return $this->hasMany(Params::class, ['id' => 'param_id'])->via('userParamRelations')->all();
    }

    public function getUserParams(){
        return $this->hasMany(UserParams::class, ['user_id' => 'id'])->asArray()->all();
    }

    public function getUserPrice(){
        return $this->hasMany(UserPrice::class, ['user_id' => 'id'])->asArray()->all();
    }
}
