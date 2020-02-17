<?php

namespace frontend\modules\user\models;

use common\models\Params;
use common\models\Service;
use frontend\models\UserParams;
use frontend\models\UserService;
use Yii;
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

    public function formatDate(){
        $this->birthday = \date('d.m.Y' , $this->birthday );
    }

    public static function getPopular($city){
        return Profile::find()->limit(12)->where(['city' => $city])->all();
    }

    public function getAvatar(){
        $this->avatar = ArrayHelper::getValue(Photo::find()->where(['avatar' => 1])->andWhere(['user_id' => $this->id])->asArray()->one(), 'file');
    }

    /**
     * @param $params
     * @return array|\yii\db\ActiveQuery|ActiveRecord[]
     */
    public function getByParams($params)
    {

        $params = explode('/', $params);

        $ids = array();

        $query_params = array();
        $bread_crumbs_params = array();

        //Перебираем параметры
        foreach ($params as $value) {

            if (strstr($value, 'metro')){

                $url = str_replace('metro-', '', $value);

                $id = Metro::find()->where(['url' => $url])->asArray()->one();

                if($id){

                    $bread_crumbs_params[] = [
                        'url' => '/'.$value,
                        'label' => $id['value']
                    ];

                    if (!empty($ids)){

                        $ids2 = UserToMetro::find()->where(['metro_id' => $id['id']])->asArray()->all();

                        foreach ($ids2 as $item){

                            foreach ($ids as $item2){

                                if ($item['post_id'] == $item2['post_id']) $result_id_array[] = $item2;

                            }

                        }

                        $ids = $result_id_array;

                    }else{

                        $ids = UserToMetro::find()->where(['metro_id' => $id['id']])->asArray()->all();

                    }

                    if (empty($ids)){
                        $ids[] = [
                            '0' => 0
                        ];
                    }

                }

            }

            if (strstr($value, 'rayon')){

                $url = str_replace('rayon-', '', $value);

                $id = Rayon::find()->where(['url' => $url])->andWhere('')->asArray()->one();

                if($id){

                    $bread_crumbs_params[] = [
                        'url' => '/'.$value,
                        'label' => $id['value']
                    ];


                    if (!empty($ids)){

                        $ids2 = UserToRayon::find()->where(['rayon_id' => $id['id']])->asArray()->all();

                        foreach ($ids2 as $item){

                            foreach ($ids as $item2){

                                if ($item['post_id'] == $item2['post_id']) $result_id_array[] = $item2;

                            }

                        }

                        $ids = $result_id_array;

                    }else{

                        $ids = UserToRayon::find()->where(['rayon_id' => $id['id']])->asArray()->all();

                    }

                    if (empty($ids)){
                        $ids[] = [
                            '0' => 0
                        ];
                    }

                }

            }

            if (strstr($value, 'vremya-raboty')){

                $url = str_replace('vremya-raboty-', '', $value);

                $id = Time::find()->where(['url' => $url])->asArray()->one();

                if($id){

                    $bread_crumbs_params[] = [
                        'url' => '/'.$value,
                        'label' => $id['value']
                    ];

                    $result_id_array = array();

                    if (!empty($ids)){

                        $ids2 = UserToTime::find()->where(['time_id' => $id['id']])->asArray()->all();

                        foreach ($ids2 as $item){

                            foreach ($ids as $item2){

                                if ($item['post_id'] == $item2['post_id']) $result_id_array[] = $item2;

                            }

                        }

                        $ids = $result_id_array;

                    }else{

                        $ids = UserToTime::find()->where(['time_id' => $id['id']])->asArray()->all();

                    }

                }

            }

            if (strstr($value, 'usluga')){

                $url = str_replace('usluga-', '', $value);

                $id = \frontend\models\Service::find()->where(['url' => $url])->asArray()->one();


                if($id){

                    $bread_crumbs_params[] = [
                        'url' => '/'.$value,
                        'label' => $id['value']
                    ];

                    $result_id_array = array();

                    if (!empty($ids)){

                        $ids2 = UserToService::find()->where(['service_id' => $id['id']])->asArray()->all();

                        foreach ($ids2 as $item){

                            foreach ($ids as $item2){

                                if ($item['post_id'] == $item2['post_id']) $result_id_array[] = $item2;

                            }

                        }

                        $ids = $result_id_array;

                    }else{

                        $ids = UserToService::find()->where(['service_id' => $id['id']])->asArray()->all();

                    }

                }

            }

            if (strstr($value, 'place')){

                $url = str_replace('place-', '', $value);

                $id = Place::find()->where(['url' => $url])->asArray()->one();


                if($id){

                    $bread_crumbs_params[] = [
                        'url' => '/'.$value,
                        'label' => $id['value']
                    ];

                    $result_id_array = array();

                    if (!empty($ids)){

                        $ids2 = UserToPlace::find()->where(['place_id' => $id['id']])->asArray()->all();

                        foreach ($ids2 as $item){

                            foreach ($ids as $item2){

                                if ($item['post_id'] == $item2['post_id']) $result_id_array[] = $item2;

                            }

                        }

                        $ids = $result_id_array;

                    }else{

                        $ids = UserToPlace::find()->where(['place_id' => $id['id']])->asArray()->all();

                    }

                }

            }

            if (strstr($value, 'vozrast')){

                $url = str_replace('vozrast-', '', $value);

                $age_params = array();

                if ($url == 'ot-18-do-20-let') {
                    $age_params[] = ['>=', 'age' , 18];
                    $age_params[] = ['<=', 'age' , 20];
                }

                if ($url == 'ot-21-do-25-let') {
                    $age_params[] = ['>=', 'age' , 21];
                    $age_params[] = ['<=', 'age' , 25];
                }

                if ($url == 'ot-26-do-30-let') {
                    $age_params[] = ['>=', 'age' , 26];
                    $age_params[] = ['<=', 'age' , 30];
                }

                if ($url == 'ot-31-do-35-let') {
                    $age_params[] = ['>=', 'age' , 31];
                    $age_params[] = ['<=', 'age' , 35];
                }

                if ($url == 'ot-36-do-40-let') {
                    $age_params[] = ['>=', 'age' , 36];
                    $age_params[] = ['<=', 'age' , 40];
                }

                if ($url == 'ot-41-do-45-let') {
                    $age_params[] = ['>=', 'age' , 41];
                    $age_params[] = ['<=', 'age' , 45];
                }

                if ($url == 'ot-46-do-50-let') {
                    $age_params[] = ['>=', 'age' , 46];
                    $age_params[] = ['<=', 'age' , 50];
                }

                if ($url == 'ot-51-do-55-let') {
                    $age_params[] = ['>=', 'age' , 51];
                    $age_params[] = ['<=', 'age' , 55];
                }

                if ($url == 'starshe-55') {
                    $age_params[] = ['>=', 'age' , 55];
                }

                $age = Age::find()->where(['url' => $url])->asArray()->one();

                if ($age){

                    $bread_crumbs_params[] = [
                        'url' => '/'.$value,
                        'label' => $age['value']
                    ];

                }

                $id = AgeToUser::find();

                foreach ($age_params as $age_param){
                    $id->andWhere($age_param);
                }

                $id = $id->asArray()->all();


                if($id){

                    $result_id_array = array();

                    if (!empty($ids)){

                        foreach ($id as $id_item){

                            $result[] = ArrayHelper::getValue($id_item, 'post_id');

                        }

                        $ids2 = $id;

                        foreach ($ids2 as $item){

                            foreach ($ids as $item2){

                                if ($item['id'] == $item2['post_id']) $result_id_array[] = $item2;

                            }

                        }

                        $ids = $result_id_array;

                    }else{

                        foreach ($id as $id_item){

                            $result[] = ArrayHelper::getValue($id_item, 'post_id');

                        }

                        $ids = $id;

                    }

                }

            }

            if (strstr($value, 'price')){

                $url = str_replace('price-', '', $value);

                $price_params = array();

                if ($url == 'do-1500') $price_params[] = ['<', 'price' , 1500];

                if ($url == 'ot-1500-do-2000') {
                    $price_params[] = ['>=', 'price' , 1500];
                    $price_params[] = ['<=', 'price' , 1999];
                }
                if ($url == 'ot-2000-do-3000') {
                    $price_params[] = ['>=', 'price' , 2000];
                    $price_params[] = ['<=', 'price' , 2999];
                }
                if ($url == 'ot-3000-do-6000') {
                    $price_params[] = ['>=', 'price' , 3000];
                    $price_params[] = ['<=', 'price' , 6000];
                }

                if ($url == 'ot-6000') {
                    $price_params[] = ['>=', 'price' , 6001];
                }

                $price = Price::find()->where(['url' => $url])->asArray()->one();

                if ($price){

                    $bread_crumbs_params[] = [
                        'url' => '/'.$value,
                        'label' => $price['value']
                    ];

                }

                $id = UserToPrice::find();

                foreach ($price_params as $price_param){
                    $id->andWhere($price_param);
                }

                $id = $id->asArray()->all();


                if($id){

                    $result_id_array = array();


                    if (!empty($ids)){



                        foreach ($id as $id_item){

                            $result[] = ArrayHelper::getValue($id_item, 'post_id');

                        }

                        $ids2 = UserToPrice::find()->where(['in', 'post_id', $result])->asArray()->all();

                        foreach ($ids2 as $item){

                            foreach ($ids as $item2){

                                if ($item['post_id'] == $item2['post_id']) $result_id_array[] = $item2;

                            }

                        }

                        $ids = $result_id_array;

                    }else{

                        foreach ($id as $id_item){

                            $result[] = ArrayHelper::getValue($id_item, 'post_id');

                        }

                        $ids = UserToPrice::find()->where(['in', 'post_id', $result])->asArray()->all();

                    }

                }

            }

            if (strstr($value, 'national')){

                $url = str_replace('national-', '', $value);

                $national = National::find()->where(['url' => $url])->asArray()->one();

                if ($national){

                    $bread_crumbs_params[] = [
                        'url' => '/'.$value,
                        'label' => $national['value']
                    ];

                    $ids = UserToNational::find()->where(['national_id' => $national['id']])->asArray()->all();

                    if (empty($ids)){
                        $ids[] = [
                            '0' => 0
                        ];
                    }

                }

            }

            if (strstr($value, 'breast')){

                $url = str_replace('breast-', '', $value);

                $national = Breast::find()->where(['url' => $url])->asArray()->one();

                if ($national){

                    $bread_crumbs_params[] = [
                        'url' => '/'.$value,
                        'label' => $national['value']
                    ];

                    $ids = UserToBreast::find()->where(['breast_id' => $national['id']])->asArray()->all();

                    if (empty($ids)){
                        $ids[] = [
                            '0' => 0
                        ];
                    }

                }



            }

            if (strstr($value, 'intimnaya-strizhka')){

                $url = str_replace('intimnaya-strizhka-', '', $value);

                $national = IntimHaircut::find()->where(['url' => $url])->asArray()->one();

                if ($national){

                    $bread_crumbs_params[] = [
                        'url' => '/'.$value,
                        'label' => $national['value']
                    ];

                    $ids = UserToIntimHaircut::find()->where(['haircut_id' => $national['id']])->asArray()->all();

                    if (empty($ids)){
                        $ids[] = [
                            '0' => 0
                        ];
                    }

                }

            }

            if (strstr($value, 'figura')){

                $url = str_replace('figura-', '', $value);

                $national = Body::find()->where(['url' => $url])->asArray()->one();

                if ($national){

                    $bread_crumbs_params[] = [
                        'url' => '/'.$value,
                        'label' => $national['value']
                    ];

                    $ids = UserToBody::find()->where(['body_id' => $national['id']])->asArray()->all();

                    if (empty($ids)){
                        $ids[] = [
                            '0' => 0
                        ];
                    }

                }

            }

            if (strstr($value, 'cvet-volos')){

                $url = str_replace('cvet-volos-', '', $value);

                $national = Hair::find()->where(['url' => $url])->asArray()->one();

                if ($national){

                    $bread_crumbs_params[] = [
                        'url' => '/'.$value,
                        'label' => $national['value']
                    ];

                    $ids = UserToHair::find()->where(['hair_id' => $national['id']])->asArray()->all();

                    if (empty($ids)){
                        $ids[] = [
                            '0' => 0
                        ];
                    }

                }


            }

        }

        $result = array();

        if ($ids) {

            foreach ($ids as $id){

                $result[] = ArrayHelper::getValue($id, 'post_id');

                if (!empty($result)) Yii::$app->params['result_id'] = $result;

            }

            $query_params[] = ['in' , 'id' , $result];


        }

        if (!empty($query_params)){

            return $query_params;

            $posts = Profile::find();

            foreach ($query_params as $item){

                $posts->andWhere($item);

            }

            $posts = $posts->limit(12)->all();

            return $posts;

        }

    }

}
