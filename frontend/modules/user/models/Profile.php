<?php

namespace frontend\modules\user\models;

use common\models\Alcogol;
use common\models\BodyType;
use common\models\Breast;
use common\models\CeliZnakomstvamstva;
use common\models\Children;
use common\models\Education;
use common\models\Family;
use common\models\FinancialSituation;
use common\models\HairColor;
use common\models\Interesting;
use common\models\IntimHair;
use common\models\LifeGoals;
use common\models\Metro;
use common\models\National;
use common\models\Place;
use common\models\Pol;
use common\models\Professionals;
use common\models\Rayon;
use common\models\Service;
use common\models\Sexual;
use common\models\SferaDeyatelnosti;
use common\models\Smoking;
use common\models\Transport;
use common\models\VajnoeVPartnere;
use common\models\Vneshnost;
use common\models\WantFind;
use common\models\Zhile;
use frontend\models\relation\UserAlcogol;
use frontend\models\relation\UserBreast;
use frontend\models\relation\UserCeliZnakomstvamstva;
use frontend\models\relation\UserChildren;
use frontend\models\relation\UserEducation;
use frontend\models\relation\UserFamily;
use frontend\models\relation\UserIntimHair;
use frontend\models\relation\UserLifeGoals;
use frontend\models\relation\UserSferaDeyatelnosti;
use frontend\models\relation\UserSmoking;
use frontend\models\relation\UserTransport;
use frontend\models\relation\UserWantFind;
use frontend\models\relation\UserZhile;
use frontend\models\UserBody;
use frontend\models\UserFinancialSituation;
use frontend\models\UserHairColor;
use frontend\models\UserInteresting;
use frontend\models\UserNational;
use frontend\models\UserParams;
use frontend\models\UserPol;
use frontend\models\UserProfessionals;
use frontend\models\UserRost;
use frontend\models\UserService;
use frontend\models\UserSexual;
use frontend\models\UserToMetro;
use frontend\models\UserToPlace;
use frontend\models\UserToRayon;
use frontend\models\UserVajnoeVPartnere;
use frontend\models\UserVes;
use frontend\models\UserVneshnost;
use frontend\modules\user\User;
use yii\db\ActiveRecord;
use frontend\models\UserPrice;
use yii\helpers\ArrayHelper;


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
 * @property integer|null $birthday
 * @property integer|null $pol
 * @property string|null $phone
 * @property int|null $cash
 * @property int|null $fake
 */
class Profile extends \yii\db\ActiveRecord
{

    public $avatar;
    public $pol;

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
            [['username', 'auth_key', 'password_hash', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at', 'cash', 'fake'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token', 'city'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['password_reset_token'], 'unique'],
            [['phone', 'pol', 'birthday'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Почта',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'city' => 'Город',
            'pol' => 'Пол',
            'phone' => 'Телефон',
            'birthday' => 'Дата рождения',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {

        if ($this->pol){

            UserPol::deleteAll('user_id = '.$this->id);

            $user_pol = new UserPol();

            $user_pol->user_id = $this->id;

            $user_pol->pol_id = $this->pol;

            $user_pol->save();

        }

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
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
     * @return \yii\db\ActiveQuery
     */
    public function getUserAvatarRelations()
    {
        return $this->hasOne(Photo::className(), ['user_id' => 'id'])->where(['avatar' => 1]);
    }

    public function getUserPrice(){
        return $this->hasMany(UserPrice::class, ['user_id' => 'id'])->asArray()->one();
    }

    public function formatDate(){
        $this->birthday = \date('d.m.Y' , $this->birthday );
    }

    public static function getPopular(){
        return Profile::find()->limit(6)->with('userAvatarRelations')->orderBy(['fake' => SORT_DESC, 'sort' => SORT_DESC])->all();
    }

    public function getAvatar(){
        $this->avatar = ArrayHelper::getValue(Photo::find()->where(['avatar' => 1])->andWhere(['user_id' => $this->id])->asArray()->one(), 'file');
    }

    public function getAvatarRelation(){
        return $this->hasOne(Photo::class, ['user_id' => 'id'])->andWhere(['avatar' => 1]);
    }

    public function getPol(){

        return ArrayHelper::getValue($this->hasOne(UserPol::class, ['user_id' => 'id'])->asArray()->one(), 'pol_id');

    }
    public function getPolRelation(){

        return $this->hasOne(UserPol::class, ['user_id' => 'id']);

    }

    public function getPolValue()
    {
        return $this->hasOne(Pol::class, ['id' => 'pol_id'])->via('polRelation');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToMetroRelations()
    {
        return $this->hasMany(UserToMetro::class, ['user_id' => 'id']);
    }

    /**
     * @return array|ActiveRecord[]
     */
    public function getMetro()
    {
        return $this->hasMany(Metro::class, ['id' => 'metro_id'])->via('userToMetroRelations')->asArray()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToRayonRelations()
    {
        return $this->hasMany(UserToRayon::class, ['user_id' => 'id']);
    }
    /**
     * @return array|ActiveRecord[]
     */
    public function getRayon()
    {
        return $this->hasMany(Rayon::class, ['id' => 'rayon_id'])->via('userToRayonRelations')->asArray()->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToPlaceRelations()
    {
        return $this->hasMany(UserToPlace::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasMany(Place::class, ['id' => 'place_id'])->via('userToPlaceRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToSexualRelations()
    {
        return $this->hasMany(UserSexual::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSexual()
    {
        return $this->hasMany(Sexual::class, ['id' => 'sexual_id'])->via('userToSexualRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToBodyTypeRelations()
    {
        return $this->hasMany(UserBody::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBodyType()
    {
        return $this->hasMany(BodyType::class, ['id' => 'value'])->via('userToBodyTypeRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserNationalRelations()
    {
        return $this->hasMany(UserNational::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNational()
    {
        return $this->hasMany(National::class, ['id' => 'national_id'])->via('userNationalRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFinancialSituationRelations()
    {
        return $this->hasMany(UserFinancialSituation::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinancialSituation()
    {
        return $this->hasMany(FinancialSituation::class, ['id' => 'param_id'])->via('userFinancialSituationRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserInterestingRelations()
    {
        return $this->hasMany(UserInteresting::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInteresting()
    {
        return $this->hasMany(Interesting::class, ['id' => 'param_id'])->via('userInterestingRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfessionalsRelations()
    {
        return $this->hasMany(UserProfessionals::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfessionals()
    {
        return $this->hasMany(Professionals::class, ['id' => 'param_id'])->via('userProfessionalsRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserVneshnostRelations()
    {
        return $this->hasMany(UserVneshnost::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVneshnost()
    {
        return $this->hasMany(Vneshnost::class, ['id' => 'param_id'])->via('userVneshnostRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserVajnoeVPartnereRelations()
    {
        return $this->hasMany(UserVajnoeVPartnere::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVajnoeVPartnere()
    {
        return $this->hasMany(VajnoeVPartnere::class, ['id' => 'param_id'])->via('userVajnoeVPartnereRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserChildrenRelations()
    {
        return $this->hasMany(UserChildren::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(Children::class, ['id' => 'param_id'])->via('userChildrenRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserWantFindRelations()
    {
        return $this->hasMany(UserWantFind::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWantFind()
    {
        return $this->hasMany(WantFind::class, ['id' => 'param_id'])->via('userWantFindRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCeliZnakomstvamstvaRelations()
    {
        return $this->hasMany(UserCeliZnakomstvamstva::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCeliZnakomstvamstva()
    {
        return $this->hasMany(CeliZnakomstvamstva::class, ['id' => 'param_id'])->via('userCeliZnakomstvamstvaRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserHaracterRelations()
    {
        return $this->hasMany(UserCeliZnakomstvamstva::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHaracter()
    {
        return $this->hasMany(CeliZnakomstvamstva::class, ['id' => 'param_id'])->via('userHaracterRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLifeGoalsRelations()
    {
        return $this->hasMany(UserLifeGoals::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLifeGoals()
    {
        return $this->hasMany(LifeGoals::class, ['id' => 'param_id'])->via('userLifeGoalsRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAlcogolRelations()
    {
        return $this->hasMany(UserAlcogol::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlcogol()
    {
        return $this->hasMany(Alcogol::class, ['id' => 'param_id'])->via('userAlcogolRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserEducationRelations()
    {
        return $this->hasMany(UserEducation::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducation()
    {
        return $this->hasMany(Education::class, ['id' => 'param_id'])->via('userEducationRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserBreastRelations()
    {
        return $this->hasMany(UserBreast::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBreast()
    {
        return $this->hasMany(Breast::class, ['id' => 'param_id'])->via('userBreastRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIntimHairRelations()
    {
        return $this->hasMany(UserIntimHair::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIntimHair()
    {
        return $this->hasMany(IntimHair::class, ['id' => 'param_id'])->via('userIntimHairRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserHairColorRelations()
    {
        return $this->hasMany(UserHairColor::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHairColor()
    {
        return $this->hasMany(HairColor::class, ['id' => 'value'])->via('userHairColorRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSferaDeyatelnostiRelations()
    {
        return $this->hasMany(UserSferaDeyatelnosti::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSferaDeyatelnosti()
    {
        return $this->hasMany(SferaDeyatelnosti::class, ['id' => 'param_id'])->via('userSferaDeyatelnostiRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserZhileRelations()
    {
        return $this->hasMany(UserZhile::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZhile()
    {
        return $this->hasMany(Zhile::class, ['id' => 'param_id'])->via('userZhileRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTransportRelations()
    {
        return $this->hasMany(UserTransport::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransport()
    {
        return $this->hasMany(Transport::class, ['id' => 'param_id'])->via('userTransportRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFamilyRelations()
    {
        return $this->hasMany(UserFamily::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamily()
    {
        return $this->hasMany(Family::class, ['id' => 'param_id'])->via('userFamilyRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSmokingRelations()
    {
        return $this->hasMany(UserSmoking::class, ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmoking()
    {
        return $this->hasMany(Smoking::class, ['id' => 'param_id'])->via('userSmokingRelations');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVes()
    {
        return $this->hasOne(UserVes::class, ['user_id' => 'id']);
    }    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRost()
    {
        return $this->hasOne(UserRost::class, ['user_id' => 'id']);
    }

}
