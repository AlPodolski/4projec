<?php


namespace console\controllers;

use common\models\Alcogol;
use common\models\BodyType;
use common\models\CeliZnakomstvamstva;
use common\models\Children;
use common\models\City;
use common\models\Education;
use common\models\EyeColor;
use common\models\Family;
use common\models\FilterParams;
use common\models\FinancialSituation;
use common\models\Haracter;
use common\models\Interesting;
use common\models\IntimHair;
use common\models\LifeGoals;
use common\models\Metro;
use common\models\Place;
use common\models\Pol;
use common\models\Presents;
use common\models\PresentsCategory;
use common\models\Rayon;
use common\models\Sexual;
use common\models\SferaDeyatelnosti;
use common\models\Smoking;
use common\models\Transport;
use common\models\User;
use common\models\VajnoeVPartnere;
use common\models\Vneshnost;
use common\models\Zhile;
use console\models\ImportNewsFromVk;
use Exception;
use frontend\models\Files;
use frontend\models\relation\PresentToCategory;
use frontend\models\relation\TaborUser;
use frontend\models\relation\UserAlcogol;
use frontend\models\relation\UserCeliZnakomstvamstva;
use frontend\models\relation\UserChildren;
use frontend\models\relation\UserEducation;
use frontend\models\relation\UserFamily;
use frontend\models\relation\UserHaracter;
use frontend\models\relation\UserIntimHair;
use frontend\models\relation\UserLifeGoals;
use frontend\models\relation\UserSferaDeyatelnosti;
use frontend\models\relation\UserSmoking;
use frontend\models\relation\UserTransport;
use frontend\models\relation\UserZhile;
use frontend\models\relation\UserZnakomstva;
use frontend\models\UserBody;
use frontend\models\UserEyeColor;
use frontend\models\UserFinancialSituation;
use frontend\models\UserInteresting;
use frontend\models\UserPol;
use frontend\models\UserPrice;
use frontend\models\UserProstitutki;
use frontend\models\UserRost;
use frontend\models\UserService;
use frontend\models\UserSexual;
use frontend\models\UserToMetro;
use frontend\models\UserToPlace;
use frontend\models\UserToRayon;
use frontend\models\UserVajnoeVPartnere;
use frontend\models\UserVes;
use frontend\models\UserVneshnost;
use frontend\modules\group\components\helpers\SubscribeHelper;
use frontend\modules\group\models\forms\addGroupRecordItemForm;
use frontend\modules\group\models\Group;
use frontend\modules\user\models\News;
use frontend\modules\user\models\Photo;
use frontend\modules\wall\models\forms\AddCommentForm;
use frontend\modules\wall\models\forms\AddToWallForm;
use frontend\modules\wall\models\Wall;
use Yii;
use yii\console\Controller;
use League\Csv\Reader;
use League\Csv\Statement;
use frontend\modules\user\models\Profile;
use frontend\models\UserHairColor;
use yii\helpers\ArrayHelper;
use common\models\Service;
use frontend\modules\advert\models\Advert;
use yii\imagine\Image;
use Imagick;

class ImportController extends Controller
{

    public function actionCustom()
    {
        $profiles = Profile::find()->where(['email' => 'adminadultero@mail.com'])->asArray()->all();

        foreach ($profiles as $profile){

            $userGroupId = SubscribeHelper::getUserSubscribe($profile['id'], Yii::$app->params['user_group_subscribe_key']);

            $wallItems = Wall::find()
                ->where(['in', 'user_id', $userGroupId])
                ->andWhere(['class' => Group::class])
                ->orderBy(['rand()' => SORT_DESC])
                ->limit(\rand(20, 40))
                ->asArray()
                ->all();

            foreach ($wallItems as $wallItem){

                $feedItem = new Wall();
                $feedItem->user_id = $profile['id'];
                $feedItem->from = $profile['id'];
                $feedItem->class = Profile::class;
                $feedItem->parent_id = $wallItem['id'];
                $feedItem->save();

            }

        }

    }

    public function actionGroupContent()
    {
        $stream = \fopen(Yii::getAlias('@app/files/group_content.csv'), 'r');

        $csv = Reader::createFromStream($stream);
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);

        //build a statement
        $stmt = (new Statement());

        $records = $stmt->process($csv);

        $i = 0;

        foreach ($records as $record) {

            if (!ImportNewsFromVk::find()->where(['group_url' => $record['url'], 'time' => $record['time']])->asArray()->one()){

                $groupInfo = Group::find()->where(['vk_url' => $record['url']])->with('admin')->asArray()->one();

                $transaction = Yii::$app->db->beginTransaction();

                $item = new addGroupRecordItemForm();

                $item->class = 'frontend\modules\group\models\Group';
                $item->user_id = $groupInfo['admin']['id'];
                $item->group_id = $groupInfo['id'];
                $item->text = \strip_tags($record['text']);
                $item->time = (\time() - (3600 * 24 * 180)) + \rand(0, 3600 * 24 * 210);

                $importNewsFromVk = new ImportNewsFromVk();

                $importNewsFromVk->group_url = $record['url'];
                $importNewsFromVk->time = $record['time'];

                if ($importNewsFromVk->save() and $wallItem = $item->save()){

                    if ($record['img']){

                        $model = new Files();

                        $model->related_class = Wall::class;
                        $model->related_id = $wallItem['id'];
                        $model->main = 0;
                        $model->file = '/files/uploads/aa12/'.$record['img'];

                        $model->save();

                    }

                    $transaction->commit();

                }
                else $transaction->rollBack();

            }

        }

    }

    public function actionGroup()
    {
        $stream = \fopen(Yii::getAlias('@app/files/group.csv'), 'r');

        $csv = Reader::createFromStream($stream);
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);

        //build a statement
        $stmt = (new Statement());

        $records = $stmt->process($csv);

        foreach ($records as $record) {

            $profile = Profile::find()->where(['email'=> 'admin@mail.com'])
                ->orderBy(['rand()' => SORT_DESC])
                ->asArray()->one();

            $group = new Group();
            $group->name = $record['name'];
            $group->vk_url = $record['url'];
            $group->category = $record['cat'];
            $group->user_id = $profile['id'];

            $group->save();

            if (isset($record['mini'])) {

                $userPhoto = new Files();

                $userPhoto->related_id = $group->id;
                $userPhoto->file = \str_replace('files', '/files/uploads/aa11', $record['mini']);
                $userPhoto->main = 1;
                $userPhoto->related_class = Group::class;

                $userPhoto->save();

            }

        }

    }

    public function actionSub()
    {

        $posts = Profile::find()->where(['fake' => 0])
            ->andWhere(['email' => 'adminadultero@mail.com'])
            ->select('id')
            ->asArray()->all();

        foreach ($posts as $post){

            $limit = \rand(10 , 30);

            $groups = Group::find()->asArray()
                ->limit($limit)
                ->orderBy(['rand()' => SORT_DESC])
                ->all();

            foreach ($groups as $group){

                SubscribeHelper::Subscribe(
                    $group['id'],
                    $post['id'],
                    Yii::$app->params['group_subscribe_key'],
                    Yii::$app->params['user_group_subscribe_key']
                );

            }

        }
    }

    public function actionWall()
    {
        // 1 m 2 j

        $citys = City::find()->asArray()->all();
        $stream = \fopen(Yii::getAlias('@app/files/stena_com.csv'), 'r');

        foreach ($citys as $city) {

            $profiles = Profile::find()->asArray()->where(['city' => $city['url']])->with('polRelation')->all();

            $csv = Reader::createFromStream($stream);
            $csv->setDelimiter(';');
            $csv->setHeaderOffset(0);

            $userPol = UserPol::find()->asArray()->all();

            //build a statement
            $stmt = (new Statement());

            $records = $stmt->process($csv);

            $i = 0;

            $items = array();

            foreach ($records as $record) {

                $i++;

                $items[] = $record;

            }


            foreach ($profiles as $profile) {

                if ($profile['polRelation']['pol_id']) {

                    if ($profile['polRelation']['pol_id'] == 1) {
                        $userToInfo = $this->getNeedPolData(2, $userPol);
                    } else {
                        $userToInfo = $this->getNeedPolData(1, $userPol);
                    }


                    $data = $this->getMessageData($profile['polRelation']['pol_id'], $items);

                    if ($data) {
                        $model = new AddToWallForm();

                        $model->from = $profile['id'];
                        $model->user_id = $userToInfo['user_id'];
                        $model->created_at = \time() - (rand(1, 365) * 3600 * 24);
                        $model->text = $data['text'];

                        $model->save();
                    }

                }


            }

            echo $city['url'] . ', ';

        }


    }

    private function getMessageData($nujnui_pol, $items)
    {
        \shuffle($items);

        foreach ($items as $item) {
            if ($item['who'] == $nujnui_pol) {
                return $item;
            }
        }
    }

    private function getNeedPolData($nujnui_pol, $userPol)
    {
        \shuffle($userPol);
        foreach ($userPol as $item) {
            if ($item['pol_id'] == $nujnui_pol) {
                return $item;
            }
        }
    }

    public function actionIndex()
    {

        $celiZnakomstva = CeliZnakomstvamstva::find()->asArray()->all();
        $vajmoeVPartnere = VajnoeVPartnere::find()->asArray()->all();
        $semeinoePolojenie = Family::find()->asArray()->all();
        $sexual = Sexual::find()->asArray()->all();
        $diti = Children::find()->asArray()->all();
        $body = BodyType::find()->asArray()->all();
        $glaza = EyeColor::find()->asArray()->all();
        $vneshnost = Vneshnost::find()->asArray()->all();
        $sfera_deyatelnosti = SferaDeyatelnosti::find()->asArray()->all();
        $zhile = Zhile::find()->asArray()->all();
        $materialnoePolozhenie = FinancialSituation::find()->asArray()->all();
        $transport = Transport::find()->asArray()->all();
        $obrazovanie = Education::find()->asArray()->all();
        $lifeGoals = LifeGoals::find()->asArray()->all();
        $haracter = Haracter::find()->asArray()->all();
        $interesi = Interesting::find()->asArray()->all();
        $smoking = Smoking::find()->asArray()->all();
        $alcogol = Alcogol::find()->asArray()->all();

        $stream = \fopen(Yii::getAlias('@app/files/content_22_05_2020.csv'), 'r');

        $csv = Reader::createFromStream($stream);
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);

        //build a statement
        $stmt = (new Statement());

        $city = City::find()->asArray()->all();

        $records = $stmt->process($csv);

        $i = 0;

        $time = \time();

        foreach ($records as $record) {

            foreach ($city as $item) {

                if ($item['city'] == $record['city']) {

                    $user = new Profile();

                    $user->username = $record['name'];
                    $user->password_hash = Yii::$app->security->generateRandomString(60);
                    $user->auth_key = Yii::$app->security->generateRandomString();
                    $user->email = 'admin@mail.com';
                    $user->status = 10;
                    $user->fake = 0;
                    $user->created_at = $time;
                    $user->updated_at = $time;
                    $user->verification_token = Yii::$app->security->generateRandomString(43);
                    $user->city = $item['url'];
                    $user->text = $record['status'];

                    $user->birthday = \time() - ($record['age'] * 3600 * 24 * 365) + \rand(0, 3600 * 24 * \rand(1, 365));
                    $i++;
                    if ($user->save()) {

                        if (isset($record['znakom'])) {

                            $znakom = (array)\json_decode($record['znakom']);

                            if (isset($znakom['cel-znakomstva'])) {

                                $params = \explode(',', $znakom['cel-znakomstva']);

                                foreach ($params as $param) {

                                    foreach ($celiZnakomstva as $itemCel) {

                                        if ($itemCel['value'] == $param) {

                                            $class = new UserCeliZnakomstvamstva();

                                            $class->user_id = $user->id;
                                            $class->param_id = $itemCel['id'];
                                            $class->city_id = $item['id'];

                                            $class->save();

                                        }

                                    }


                                }

                            }

                            if (isset($znakom['vazhnoe-v-partnere'])) {

                                $params = \explode(',', $znakom['vazhnoe-v-partnere']);

                                foreach ($params as $param) {

                                    foreach ($vajmoeVPartnere as $itemCel) {

                                        if ($itemCel['value'] == $param) {

                                            $class = new UserVajnoeVPartnere();

                                            $class->user_id = $user->id;
                                            $class->param_id = $itemCel['id'];
                                            $class->city_id = $item['id'];

                                            $class->save();

                                        }

                                    }


                                }

                            }

                            if (isset($znakom['semejnoe-polozhenie'])) {

                                $params = \explode(',', $znakom['semejnoe-polozhenie']);

                                foreach ($params as $param) {

                                    foreach ($semeinoePolojenie as $itemCel) {

                                        if ($itemCel['value'] == $param) {

                                            $class = new UserFamily();

                                            $class->user_id = $user->id;
                                            $class->param_id = $itemCel['id'];
                                            $class->city_id = $item['id'];

                                            $class->save();

                                        }

                                    }


                                }

                            }

                            if (isset($znakom['orientaciya'])) {

                                if ($record['pol'] == 'true') {
                                    if ($znakom['orientaciya'] == 'традиционная') $param_id = 1;
                                    elseif ($znakom['orientaciya'] == 'гей') $param_id = 2;
                                    elseif ($znakom['orientaciya'] == 'би') $param_id = 3;
                                } else {
                                    if ($znakom['orientaciya'] == 'традиционная') $param_id = 4;
                                    elseif ($znakom['orientaciya'] == 'лесби') $param_id = 5;
                                    else  $param_id = 6;

                                }

                                $class = new UserSexual();

                                $class->user_id = $user->id;
                                $class->sexual_id = $param_id;
                                $class->city_id = $item['id'];

                                $class->save();

                            }

                            if (isset($znakom['deti'])) {

                                foreach ($diti as $item2) {

                                    if ($item2['value'] == $znakom['deti']) {

                                        $class = new UserChildren();

                                        $class->user_id = $user->id;
                                        $class->param_id = $item2['id'];
                                        $class->city_id = $item['id'];

                                        $class->save();
                                    }
                                }

                            }


                        }

                        if (isset($record['tipaj'])) {

                            $znakom = (array)\json_decode($record['tipaj']);

                            if (isset($znakom['teloslozhenie'])) {

                                foreach ($body as $item2) {

                                    if ($item2['value'] == $znakom['teloslozhenie']) {

                                        $class = new UserBody();

                                        $class->user_id = $user->id;
                                        $class->value = $item2['id'];
                                        $class->city_id = $item['id'];

                                        $class->save();
                                    }
                                }

                            }

                            if (isset($znakom['rost'])) {

                                $class = new UserRost();

                                $class->user_id = $user->id;
                                $class->value = $znakom['rost'];
                                $class->city_id = $item['id'];

                                $class->save();

                            }

                            if (isset($znakom['cvet-glaz'])) {

                                foreach ($glaza as $item2) {

                                    if ($znakom['cvet-glaz'] == $item2['value']) {

                                        $class = new UserEyeColor();

                                        $class->user_id = $user->id;
                                        $class->value = $item2['id'];
                                        $class->city_id = $item['id'];

                                        $class->save();

                                    }

                                }

                            }

                            if (isset($znakom['moya-vneshnost'])) {

                                foreach ($vneshnost as $item2) {

                                    if ($znakom['moya-vneshnost'] == $item2['value']) {

                                        $class = new UserVneshnost();

                                        $class->user_id = $user->id;
                                        $class->param_id = $item2['id'];
                                        $class->city_id = $item['id'];

                                        $class->save();

                                    }

                                }

                            }

                        }

                        if (isset($record['projee'])) {

                            $znakom = (array)\json_decode($record['projee']);

                            if (isset($znakom['sfera-deyatelnosti'])) {

                                foreach ($sfera_deyatelnosti as $item2) {

                                    if ($item2['value'] == $znakom['sfera-deyatelnosti']) {

                                        $class = new UserSferaDeyatelnosti();

                                        $class->user_id = $user->id;
                                        $class->param_id = $item2['id'];
                                        $class->city_id = $item['id'];

                                        $class->save();
                                    }
                                }

                            }

                            if (isset($znakom['zhile'])) {

                                foreach ($zhile as $item2) {

                                    if ($item2['value'] == $znakom['zhile']) {

                                        $class = new UserZhile();

                                        $class->user_id = $user->id;
                                        $class->param_id = $item2['id'];
                                        $class->city_id = $item['id'];

                                        $class->save();
                                    }
                                }

                            }

                            if (isset($znakom['materialnoe-polozhenie'])) {

                                foreach ($materialnoePolozhenie as $item2) {

                                    if ($item2['value'] == $znakom['materialnoe-polozhenie']) {

                                        $class = new UserFinancialSituation();

                                        $class->user_id = $user->id;
                                        $class->param_id = $item2['id'];
                                        $class->city_id = $item['id'];

                                        $class->save();
                                    }
                                }

                            }

                            if (isset($znakom['transport'])) {

                                foreach ($transport as $item2) {

                                    if ($item2['value'] == $znakom['transport']) {

                                        $class = new UserTransport();

                                        $class->user_id = $user->id;
                                        $class->param_id = $item2['id'];
                                        $class->city_id = $item['id'];

                                        $class->save();
                                    }
                                }

                            }

                            if (isset($znakom['obrazovanie'])) {

                                foreach ($obrazovanie as $item2) {

                                    if ($item2['value'] == $znakom['obrazovanie']) {

                                        $class = new UserEducation();

                                        $class->user_id = $user->id;
                                        $class->param_id = $item2['id'];
                                        $class->city_id = $item['id'];

                                        $class->save();
                                    }
                                }

                            }

                            if (isset($znakom['zhiznennie-prioriteti'])) {

                                foreach ($lifeGoals as $item2) {

                                    $params = \explode(',', $znakom['zhiznennie-prioriteti']);

                                    foreach ($params as $param)

                                        if ($item2['value'] == $param) {

                                            $class = new UserLifeGoals();

                                            $class->user_id = $user->id;
                                            $class->param_id = $item2['id'];
                                            $class->city_id = $item['id'];

                                            $class->save();
                                        }
                                }

                            }

                            if (isset($znakom['cherti-haraktera'])) {

                                foreach ($haracter as $item2) {

                                    $params = \explode(',', $znakom['cherti-haraktera']);

                                    foreach ($params as $param)

                                        if ($item2['value'] == $param) {

                                            $class = new UserHaracter();

                                            $class->user_id = $user->id;
                                            $class->param_id = $item2['id'];
                                            $class->city_id = $item['id'];

                                            $class->save();
                                        }
                                }

                            }

                            if (isset($znakom['interesi-i-uvlecheniya'])) {

                                foreach ($interesi as $item2) {

                                    $params = \explode(',', $znakom['interesi-i-uvlecheniya']);

                                    foreach ($params as $param)

                                        if ($item2['value'] == $param) {

                                            $class = new UserInteresting();

                                            $class->user_id = $user->id;
                                            $class->param_id = $item2['id'];
                                            $class->city_id = $item['id'];

                                            $class->save();
                                        }
                                }

                            }

                            if (isset($znakom['otnoshenie-k-kureniyu'])) {

                                foreach ($smoking as $item2) {

                                    if ($item2['value'] == $znakom['otnoshenie-k-kureniyu']) {

                                        $class = new UserSmoking();

                                        $class->user_id = $user->id;
                                        $class->param_id = $item2['id'];
                                        $class->city_id = $item['id'];

                                        $class->save();
                                    }
                                }

                            }

                            if (isset($znakom['otnoshenie-k-alkogolyu'])) {

                                foreach ($alcogol as $item2) {

                                    if ($item2['value'] == $znakom['otnoshenie-k-alkogolyu']) {

                                        $class = new UserAlcogol();

                                        $class->user_id = $user->id;
                                        $class->param_id = $item2['id'];
                                        $class->city_id = $item['id'];

                                        $class->save();
                                    }
                                }

                            }


                        }

                        $userPol = new UserPol();
                        $userPol->user_id = $user->id;
                        $userPol->city_id = $item['id'];

                        if ($record['pol'] == 'true') {
                            $userPol->pol_id = 1;

                        } else {
                            $userPol->pol_id = 2;
                        }


                        $userPol->save();

                        $userZnakom = new UserZnakomstva();

                        $userZnakom->user_id = $user->id;
                        $userZnakom->param_id = 1;
                        $userZnakom->city_id = $item['id'];

                        $userZnakom->save();


                        if (isset($record['tabor_id'])) {
                            $userTabor = new TaborUser();

                            $userTabor->user_id = $user->id;
                            $userTabor->tabor_id = $record['tabor_id'];
                            $userTabor->save();
                        }


                        if (isset($record['photo_mii'])) {

                            $userPhoto = new Photo();

                            $userPhoto->user_id = $user->id;
                            $userPhoto->file = \str_replace('files', '/files/uploads/aa6', $record['photo_mii']);
                            $userPhoto->avatar = 1;

                            $userPhoto->save();

                        }

                        if (isset($record['gal'])) {


                            $gall = \explode(',', $record['gal']);

                            if ($gall) {

                                foreach ($gall as $gallitem) {

                                    if ($gallitem) {

                                        $userPhoto = new Photo();

                                        $userPhoto->user_id = $user->id;
                                        $userPhoto->file = \str_replace('\r\n', '', '/files/uploads/aa6/' . $gallitem);
                                        $userPhoto->avatar = 0;

                                        $userPhoto->save();

                                    }

                                }

                            }

                        }

                    }

                }

            }

        }

        echo $i;
    }

    public function actionImportDescr()
    {
        $stream = \fopen(Yii::getAlias('@app/files/opisamie_dlya_anket_24_07_2020.csv'), 'r');

        $csv = Reader::createFromStream($stream);
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);

        //build a statement
        $stmt = (new Statement());

        $city = City::find()->asArray()->all();

        $records = $stmt->process($csv);

        $i = 0;

        $time = \time();

        foreach ($records as $record) {

            $descItems[] = $record;

        }

        foreach ($city as $item){

            $posts = UserPol::find()->where(['pol_id' => 2, 'city_id' => $item['id']])->with('fakeProfile')->all();

            foreach ($posts as $post){

                if (\rand(0, 2) != 2){

                    $text = $descItems[\array_rand($descItems)];

                    if (isset($text['text']) and !empty($text['text'])){

                        if($post->fakeProfile){

                            @$post->fakeProfile->text = $text['text'];

                            @$post->fakeProfile->save();

                        }

                    }

                }

            }

        }

    }

    public function actionImport()
    {

        $names = $this->getNames(2);

        $celiZnakomstva = CeliZnakomstvamstva::find()->asArray()->all();
        $vajmoeVPartnere = VajnoeVPartnere::find()->asArray()->all();
        $semeinoePolojenie = Family::find()->asArray()->all();
        $sexual = Sexual::find()->asArray()->all();
        $diti = Children::find()->asArray()->all();
        $body = BodyType::find()->asArray()->all();
        $glaza = EyeColor::find()->asArray()->all();
        $vneshnost = Vneshnost::find()->asArray()->all();
        $sfera_deyatelnosti = SferaDeyatelnosti::find()->asArray()->all();
        $zhile = Zhile::find()->asArray()->all();
        $materialnoePolozhenie = FinancialSituation::find()->asArray()->all();
        $transport = Transport::find()->asArray()->all();
        $obrazovanie = Education::find()->asArray()->all();
        $lifeGoals = LifeGoals::find()->asArray()->all();
        $haracter = Haracter::find()->asArray()->all();
        $interesi = Interesting::find()->asArray()->all();
        $smoking = Smoking::find()->asArray()->all();
        $alcogol = Alcogol::find()->asArray()->all();

        $stream = \fopen(Yii::getAlias('@app/files/content_ero_17_08_2020.csv'), 'r');

        $csv = Reader::createFromStream($stream);
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);

        //build a statement
        $stmt = (new Statement());

        $city = City::find()->asArray()->all();

        $records = $stmt->process($csv);

        $time = \time();

        foreach ($records as $record) {

            $articles[] = $record;

        }

        foreach ($city as $item) {

            $tempArticles = $articles;

            $i = 0;

            $userCityCount = Profile::find()->where(['city' => $item['url']])->count();

            while ($i < ($userCityCount / 10)) {

                $i++;

                $record = $tempArticles[\array_rand($tempArticles)];

                $user = new Profile();

                $user->username = $names[\array_rand($names)];
                $user->password_hash = Yii::$app->security->generateRandomString(60);
                $user->auth_key = Yii::$app->security->generateRandomString();
                $user->email = 'adminadultero@mail.com';
                $user->status = 10;
                $user->fake = 0;
                $user->created_at = 0;
                $user->updated_at = 0;
                $user->verification_token = Yii::$app->security->generateRandomString(43);
                $user->city = $item['url'];
                //$user->text = \strip_tags($record['about']);

                //if (!empty($record['age']) and \is_numeric($record['age'])) $user->birthday = \time() - ($record['age'] * 3600 * 24 * 365) + \rand(0, 3600 * 24 * \rand(1, 365));

                if ($user->save()) {

                    foreach ($celiZnakomstva as $itemCel) {

                        if (\rand(0, 2) != 2) {

                            $class = new UserCeliZnakomstvamstva();

                            $class->user_id = $user->id;
                            $class->param_id = $itemCel['id'];
                            $class->city_id = $item['id'];

                            $class->save();

                        }

                    }

                    foreach ($vajmoeVPartnere as $itemCel) {

                        if (\rand(0, 2) != 2) {

                            $class = new UserVajnoeVPartnere();

                            $class->user_id = $user->id;
                            $class->param_id = $itemCel['id'];
                            $class->city_id = $item['id'];

                            $class->save();

                        }

                    }

                    foreach ($semeinoePolojenie as $itemCel) {

                        if (\rand(0, 2) != 2) {

                            $class = new UserFamily();

                            $class->user_id = $user->id;
                            $class->param_id = $itemCel['id'];
                            $class->city_id = $item['id'];

                            $class->save();

                            break;

                        }

                    }

                    if (isset($znakom['rost'])) {

                        $class = new UserRost();

                        $class->user_id = $user->id;
                        $class->value = $znakom['rost'];
                        $class->city_id = $item['id'];

                        $class->save();

                    }

                    foreach ($sfera_deyatelnosti as $item2) {

                        if (\rand(0, 2) != 2) {

                            $class = new UserSferaDeyatelnosti();

                            $class->user_id = $user->id;
                            $class->param_id = $item2['id'];
                            $class->city_id = $item['id'];

                            $class->save();

                            break;

                        }
                    }

                    foreach ($zhile as $item2) {

                        if (\rand(0, 2) != 2) {

                            $class = new UserZhile();

                            $class->user_id = $user->id;
                            $class->param_id = $item2['id'];
                            $class->city_id = $item['id'];

                            $class->save();

                            break;

                        }
                    }

                    foreach ($interesi as $item2) {

                        if (\rand(0, 2) != 2) {

                            $class = new UserInteresting();

                            $class->user_id = $user->id;
                            $class->param_id = $item2['id'];
                            $class->city_id = $item['id'];

                            $class->save();
                        }
                    }

                    $userPol = new UserPol();
                    $userPol->user_id = $user->id;
                    $userPol->city_id = $item['id'];

                    $userPol->pol_id = 2;

                    $userPol->save();

                    $userZnakom = new UserZnakomstva();

                    $userZnakom->user_id = $user->id;
                    $userZnakom->param_id = 1;
                    $userZnakom->city_id = $item['id'];

                    $userZnakom->save();

                    $userOrientaciya = new UserSexual();

                    $userOrientaciya->sexual_id = 1;
                    $userOrientaciya->city_id = $item['id'];
                    $userOrientaciya->user_id = $user->id;

                    $userOrientaciya->save();

                    if (isset($record['mini'])) {

                        $userPhoto = new Photo();

                        $userPhoto->user_id = $user->id;
                        $userPhoto->file = \str_replace('files', '/files/uploads/aa10', $record['mini']);
                        $userPhoto->avatar = 1;

                        $userPhoto->save();

                    }

                    if (isset($record['gal'])) {

                        $gall = \explode(',', $record['gal']);

                        if ($gall) {

                            foreach ($gall as $gallitem) {

                                if ($gallitem) {

                                    $userPhoto = new Photo();

                                    $userPhoto->user_id = $user->id;
                                    $userPhoto->file = '/files/uploads/aa10'.\str_replace('files', '',   $gallitem);
                                    $userPhoto->avatar = 0;

                                    $userPhoto->save();

                                }

                            }

                        }

                    }

                }

            }

        }

    }

    public function actionCrop()
    {

        $profiles = Profile::find()->where(['email' => 'adminadultero@mail.com'])->select('id')->asArray()
            ->all();

        $profilesId = ArrayHelper::getColumn($profiles, 'id');

        $photos = Photo::find()->where(['in', 'id' , $profilesId])->asArray()->all();

       foreach ($photos as $photo){

            $file = Yii::getAlias('@frontend/web').$photo['file'];

            $imageInfo = \getimagesize($file);

            $width = $imageInfo[0];

            $height = $imageInfo[1] ;

           try {
               $imagic = new Imagick($file);

               $imagic->cropImage($width   , $height - 150 , 0, 50);

               $imagic->setImageFormat('jpg');

               file_put_contents($file, $imagic);

               unset($imagic);
           }catch (Exception $e){
               echo $e->getMessage();
           }



        }

    }

    private function getNames($pol_id = 1){

        $womenIds = UserPol::find()->where(['pol_id' => $pol_id])->asArray()->all();

        return ArrayHelper::getColumn( Profile::find()->where(['in' , 'id' ,ArrayHelper::getColumn($womenIds, 'user_id') ])
            ->distinct()
            ->select('username')
            ->asArray()
            ->all(), 'username');

    }

    public function actionPresents()
    {

        $category = PresentsCategory::find()->asArray()->all();

        $stream = \fopen(Yii::getAlias('@app/files/presents.csv'), 'r');

        $csv = Reader::createFromStream($stream);
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);

        //build a statement
        $stmt = (new Statement());

        $records = $stmt->process($csv);

        $i = 0;

        foreach ($records as $record) {

            foreach ($category as $item) {

                if ($item['category_name'] == $record['category']) {

                    $present = new Presents();
                    $present->name = $record['name'];
                    $present->price = $record['cifr'];
                    $present->img = '/files/presents/' . $record['img'];
                    $present->status = Presents::PODAROK_DOSTUPEN;

                    if ($present->save()) {

                        $present_to_category = new PresentToCategory();
                        $present_to_category->present_id = $present->id;
                        $present_to_category->category_id = $item['id'];

                        if ($present_to_category->save()) echo 'da';

                    }

                }

            }

        }
    }

    public function actionAdvert()
    {
        $stream = \fopen(Yii::getAlias('@app/files/advert_import_16_03_2020.csv'), 'r');

        $csv = Reader::createFromStream($stream);
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);

        //build a statement
        $stmt = (new Statement());

        $city = City::find()->asArray()->all();

        $records = $stmt->process($csv);

        $i = 0;

        foreach ($records as $record) {

            $advert = new Advert();

            $advert->title = $record['h1'];
            $advert->text = $record['content'] . ' ' . $record['contact'];
            $advert->timestamp = \time() - \rand(0, 365 * 2) * 3600 * 24;

            $advert->save();

            $i++;

        }
    }

    public function actionPropPr()
    {

        $city = City::find()->asArray()->all();

        $profiles = Profile::find()->where(['city' => 'msk'])->asArray()->all();

        foreach ($profiles as $profile) {

            foreach ($city as $cityItem) {

                if ($cityItem['url'] == $profile['city']) {
                    $rayon = $this->addRayon($cityItem['id'], $profile['id']);
                    $this->addMetro($cityItem['id'], $profile['id'], $rayon);
                    /*$this->addService($cityItem['id'], $profile['id']);
                    $this->addTransport($cityItem['id'], $profile['id']);
                    $this->addZhile($cityItem['id'], $profile['id']);
                    $this->addEducation($cityItem['id'], $profile['id']);
                    $this->addCeliZnakomstvamstva($cityItem['id'], $profile['id']);
                    $this->addDeti($cityItem['id'], $profile['id']);
                    $this->addVajnoeVPartnere($cityItem['id'], $profile['id']);
                    $this->addPlace($cityItem['id'], $profile['id']);
                    $this->addFinPolojenie($cityItem['id'], $profile['id']);
                    $this->addSexual($cityItem['id'], $profile['id']);
                    $this->addBody($cityItem['id'], $profile['id']);
                    $this->addCeli($cityItem['id'], $profile['id']);
                    $this->addSmoke($cityItem['id'], $profile['id']);
                    $this->addAlcohol($cityItem['id'], $profile['id']);
                    $this->addObrazovanie($cityItem['id'], $profile['id']);
                    $this->addIntimHair($cityItem['id'], $profile['id']);
                    $this->addInteresy($cityItem['id'], $profile['id']);
                    $this->addHaracter($cityItem['id'], $profile['id']);
                    $this->addVneshnost($cityItem['id'], $profile['id']);
                    $this->addMestoVstreji($cityItem['id'], $profile['id']);*/
                }

            }

        }

    }

    public function actionTresh()
    {
        $stream = \fopen(Yii::getAlias('@app/files/article_all_2_laguna.csv'), 'r');

        $csv = Reader::createFromStream($stream);
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);

        //build a statement
        $stmt = (new Statement());

        $city = City::find()->asArray()->all();

        $records = $stmt->process($csv);

        $i = 0;

        foreach ($records as $record) {

            if ($record['znakomstva'] == 1) {

                foreach ($city as $item) {

                    $user = new Profile();

                    $user->username = $record['h1'];
                    $user->password_hash = Yii::$app->security->generateRandomString(60);
                    $user->auth_key = Yii::$app->security->generateRandomString();
                    $user->email = 'admin@mail.com';
                    $user->status = 10;
                    $user->created_at = $time = \time();
                    $user->updated_at = $time;
                    $user->verification_token = Yii::$app->security->generateRandomString(43);
                    $user->city = $item['url'];
                    $user->text = $record['obyav'];

                    $i++;

                    if ($user->save()) {

                        $userZnakom = new UserZnakomstva();

                        $userZnakom->user_id = $user->id;
                        $userZnakom->param_id = 1;
                        $userZnakom->city_id = $item['id'];

                        $userZnakom->save();

                        if (isset($record['img'])) {

                            $userPhoto = new Photo();

                            $userPhoto->user_id = $user->id;
                            $userPhoto->file = \str_replace('files', '/files/uploads/aa6', $record['img']);
                            $userPhoto->avatar = 1;

                            $userPhoto->save();

                        }

                        if (isset($record['gal'])) {

                            $gall = \explode(',', $record['gal']);

                            if ($gall) {

                                foreach ($gall as $gallitem) {

                                    if ($gallitem) {

                                        $userPhoto = new Photo();

                                        $userPhoto->user_id = $user->id;
                                        $userPhoto->file = $gallitem;
                                        $userPhoto->avatar = 0;

                                        $userPhoto->save();

                                    }

                                }

                            }

                        }

                        if ($record['kat'] == 'virt') {

                            $user_place = new UserCeliZnakomstvamstva();
                            $user_place->user_id = $user->id;
                            $user_place->param_id = 8;
                            $user_place->city_id = $item['id'];

                            $user_place->save();

                        } else {
                            $this->addCeliZnakomstvamstva($item['id'], $user->id);
                        }

                        if ($record['kat'] == 'nujen_sponsor') {

                            $user_place = new UserFinancialSituation();
                            $user_place->user_id = $user->id;
                            $user_place->param_id = 1;
                            $user_place->city_id = $item['id'];

                            $user_place->save();

                        } else {
                            $this->addFinPolojenie($item['id'], $user->id);
                        }

                        if ($record['orientaciya']) {
                            $class = new UserSexual();

                            $class->user_id = $user->id;
                            $class->sexual_id = $record['orientaciya'];
                            $class->city_id = $item['id'];

                            $class->save();
                        }

                        if ($record['pol']) {

                            $userPol = new UserPol();
                            $userPol->user_id = $user->id;
                            $userPol->city_id = $item['id'];
                            $userPol->pol_id = $record['pol'];

                            $userPol->save();

                        }


                        $this->addService($item['id'], $user->id);
                        $this->addTransport($item['id'], $user->id);
                        $this->addZhile($item['id'], $user->id);
                        $this->addEducation($item['id'], $user->id);
                        $this->addVajnoeVPartnere($item['id'], $user->id);
                        $this->addPlace($item['id'], $user->id);
                        $this->addFinPolojenie($item['id'], $user->id);
                        $this->addBody($item['id'], $user->id);
                        $this->addCeli($item['id'], $user->id);
                        $this->addSmoke($item['id'], $user->id);
                        $this->addAlcohol($item['id'], $user->id);
                        $this->addObrazovanie($item['id'], $user->id);
                        $this->addIntimHair($item['id'], $user->id);
                        $this->addInteresy($item['id'], $user->id);
                        $this->addHaracter($item['id'], $user->id);
                        $this->addVneshnost($item['id'], $user->id);
                        $this->addMestoVstreji($item['id'], $user->id);

                    }

                }

            }
        }
    }

    private function addRayon($city_id, $user_id)
    {

        if ($rayon = Rayon::find()->where(['city_id' => $city_id])->asArray()->all()) {

            $user_to_raton = new UserToRayon();
            $user_to_raton->user_id = $user_id;
            $user_to_raton->city_id = $city_id;
            $user_to_raton->rayon_id = ArrayHelper::getValue($return_rayon = $rayon[\array_rand($rayon)], 'id');

            if ($user_to_raton->save()) return $return_rayon;

        }

    }

    public function addMetro($city_user, $user_id = 1, $rayon = false)
    {


        if ($rayon) {

            $stream = \fopen(Yii::getAlias('@app/files/m-r.csv'), 'r');

            $csv = Reader::createFromStream($stream);
            $csv->setDelimiter(';');
            $csv->setHeaderOffset(0);

            //build a statement
            $stmt = (new Statement());

            $city = City::find()->asArray()->all();

            $records = $stmt->process($csv);

            foreach ($records as $record) {

                if ($rayon['value'] == $record['rayon'] and \rand(1, 3) != 3) {

                    if ($dostypnoe_metro = \explode(',', $record['metro'])) {

                        if ($metro = Metro::find()->where(['city_id' => $city_user])->andWhere(['value' => $dostypnoe_metro[\array_rand($dostypnoe_metro)]])->asArray()->one()) {

                            $user_to_metro = new UserToMetro();
                            $user_to_metro->user_id = $user_id;
                            $user_to_metro->metro_id = $metro['id'];
                            $user_to_metro->city_id = $city_user;

                            $user_to_metro->save();

                        }

                    }

                }

            }

        } else {
            if ($metro = Metro::find()->where(['city' => $city_user])->asArray()->all()) {

                $user_to_metro = new UserToMetro();
                $user_to_metro->user_id = ArrayHelper::getValue($metro[\array_rand($metro)], 'id');
                $user_to_metro->metro_id = $metro['id'];

                $user_to_metro->save();

            }
        }


    }

    public function actionSklon()
    {
        $stream = \fopen(Yii::getAlias('@app/files/sclon.csv'), 'r');

        $csv = Reader::createFromStream($stream);
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);

        //build a statement
        $stmt = (new Statement());

        $records = $stmt->process($csv);

        $i = 0;

        foreach ($records as $record) {

            if ($filter = FilterParams::find()->where(['url' => $record['filter']])->asArray()->one()) {

                $class = $filter['class_name'];

                $prop = $class::find()->where(['value' => $record['param']])->one();


                if ($prop and $record['value2'] != '') {

                    $prop->value2 = $record['value2'];

                    if ($record['value3'] != '') {

                        $prop->value3 = $record['value3'];

                    }

                    if ($record['filter'] == 'metro') ;


                    $prop->save();

                }

            }

        }
    }

    public function addService($cityId, $user_id = 1)
    {

        if ($service = Service::find()->asArray()->all()) {

            foreach ($service as $item) {

                if (\rand(0, 2) != 2) {

                    $user_place = new UserService();
                    $user_place->user_id = $user_id;
                    $user_place->service_id = $item['id'];
                    $user_place->city_id = $cityId;

                    $user_place->save();

                }

            }

        }


    }

    public function addVajnoeVPartnere($cityId, $user_id = 1)
    {

        if ($service = VajnoeVPartnere::find()->asArray()->all()) {

            foreach ($service as $item) {

                if (\rand(0, 2) != 2) {

                    $user_place = new UserVajnoeVPartnere();
                    $user_place->user_id = $user_id;
                    $user_place->param_id = $item['id'];
                    $user_place->city_id = $cityId;

                    $user_place->save();

                }

            }

        }


    }

    public function addCeliZnakomstvamstva($cityId, $user_id = 1)
    {

        if ($service = CeliZnakomstvamstva::find()->asArray()->all()) {

            foreach ($service as $item) {

                if (\rand(0, 2) != 2) {

                    $user_place = new UserCeliZnakomstvamstva();
                    $user_place->user_id = $user_id;
                    $user_place->param_id = $item['id'];
                    $user_place->city_id = $cityId;

                    $user_place->save();

                }

            }

        }


    }

    public function addCeli($cityId, $user_id = 1)
    {

        if ($service = LifeGoals::find()->asArray()->all()) {

            foreach ($service as $item) {

                if (\rand(0, 2) != 2) {

                    $user_place = new UserLifeGoals();
                    $user_place->user_id = $user_id;
                    $user_place->param_id = $item['id'];
                    $user_place->city_id = $cityId;

                    $user_place->save();

                }

            }

        }


    }

    public function addSexual($cityId, $user_id = 1)
    {

        if ($service = Sexual::find()->where(['pol_id' => 2])->asArray()->all()) {

            $user_place = new UserSexual();
            $user_place->user_id = $user_id;
            $user_place->sexual_id = ArrayHelper::getValue($service[\array_rand($service)], 'id');
            $user_place->city_id = $cityId;

            $user_place->save();

        }


    }

    public function addEducation($cityId, $user_id = 1)
    {

        if ($service = Education::find()->asArray()->all()) {

            $user_place = new UserEducation();
            $user_place->user_id = $user_id;
            $user_place->param_id = ArrayHelper::getValue($service[\array_rand($service)], 'id');
            $user_place->city_id = $cityId;

            $user_place->save();

        }


    }

    public function addTransport($cityId, $user_id = 1)
    {

        if ($service = Transport::find()->asArray()->all()) {

            $user_place = new UserTransport();
            $user_place->user_id = $user_id;
            $user_place->param_id = ArrayHelper::getValue($service[\array_rand($service)], 'id');
            $user_place->city_id = $cityId;

            $user_place->save();

        }


    }

    public function addZhile($cityId, $user_id = 1)
    {

        if ($service = Zhile::find()->asArray()->all()) {

            $user_place = new UserZhile();
            $user_place->user_id = $user_id;
            $user_place->param_id = ArrayHelper::getValue($service[\array_rand($service)], 'id');
            $user_place->city_id = $cityId;

            $user_place->save();

        }


    }

    public function addBody($cityId, $user_id = 1)
    {

        if ($service = BodyType::find()->asArray()->all()) {

            $user_place = new UserBody();
            $user_place->user_id = $user_id;
            $user_place->value = ArrayHelper::getValue($service[\array_rand($service)], 'id');
            $user_place->city_id = $cityId;

            $user_place->save();

        }

    }

    public function addFinPolojenie($cityId, $user_id = 1)
    {

        $user_place = new UserFinancialSituation();
        $user_place->user_id = $user_id;
        $user_place->param_id = 1;
        $user_place->city_id = $cityId;

        $user_place->save();

    }

    public function addDeti($cityId, $user_id = 1)
    {

        $user_place = new UserChildren();
        $user_place->user_id = $user_id;
        $user_place->param_id = 1;
        $user_place->city_id = $cityId;

        $user_place->save();

    }

    public function addPlace($cityId, $user_id = 1)
    {

        if ($service = Place::find()->asArray()->all()) {

            foreach ($service as $item) {

                if (\rand(0, 2) != 2) {

                    $user_place = new UserToPlace();
                    $user_place->user_id = $user_id;
                    $user_place->place_id = $item['id'];
                    $user_place->city_id = $cityId;

                    $user_place->save();

                }

            }

        }

    }

    public function addSmoke($cityId, $user_id = 1)
    {

        if ($service = Smoking::find()->asArray()->all()) {

            $user_place = new UserSmoking();
            $user_place->user_id = $user_id;
            $user_place->param_id = ArrayHelper::getValue($service[\array_rand($service)], 'id');
            $user_place->city_id = $cityId;

            $user_place->save();

        }

    }

    public function addAlcohol($cityId, $user_id = 1)
    {

        if ($service = Alcogol::find()->asArray()->all()) {

            $user_place = new UserAlcogol();
            $user_place->user_id = $user_id;
            $user_place->param_id = ArrayHelper::getValue($service[\array_rand($service)], 'id');
            $user_place->city_id = $cityId;

            $user_place->save();

        }

    }

    public function addObrazovanie($cityId, $user_id = 1)
    {

        if ($service = Education::find()->asArray()->all()) {

            $user_place = new UserEducation();
            $user_place->user_id = $user_id;
            $user_place->param_id = ArrayHelper::getValue($service[\array_rand($service)], 'id');
            $user_place->city_id = $cityId;

            $user_place->save();

        }

    }

    public function addIntimHair($cityId, $user_id = 1)
    {

        if ($service = IntimHair::find()->asArray()->all()) {

            $user_place = new UserIntimHair();
            $user_place->user_id = $user_id;
            $user_place->param_id = ArrayHelper::getValue($service[\array_rand($service)], 'id');
            $user_place->city_id = $cityId;

            $user_place->save();

        }

    }

    public function addInteresy($cityId, $user_id = 1)
    {

        if ($service = Interesting::find()->asArray()->all()) {

            foreach ($service as $item) {

                if (\rand(0, 2) != 2) {

                    $class = new UserInteresting();
                    $class->user_id = $user_id;
                    $class->param_id = $item['id'];
                    $class->city_id = $cityId;

                    $class->save();

                }

            }

        }

    }

    public function addHaracter($cityId, $user_id = 1)
    {

        if ($service = Haracter::find()->asArray()->all()) {

            foreach ($service as $item) {

                if (\rand(0, 3) != 3) {

                    $class = new UserHaracter();
                    $class->user_id = $user_id;
                    $class->param_id = $item['id'];
                    $class->city_id = $cityId;

                    $class->save();

                }

            }

        }

    }

    public function addVneshnost($cityId, $user_id = 1)
    {

        if ($service = Vneshnost::find()->asArray()->all()) {

            $service = $service[\array_rand($service)];

            $class = new UserVneshnost();
            $class->user_id = $user_id;
            $class->param_id = $service['id'];
            $class->city_id = $cityId;
            $class->save();

        }

    }

    public function addMestoVstreji($cityId, $user_id = 1)
    {

        if ($mesto = Place::find()->asArray()->all()) {

            foreach ($mesto as $mestoItem) {

                if (\rand(0, 1) == 1) {

                    $user_place = new UserToPlace();
                    $user_place->user_id = $user_id;
                    $user_place->place_id = $mestoItem['id'];
                    $user_place->city_id = $cityId;

                    $user_place->save();

                }

            }

        }


    }


    public function actionCity()
    {
        $citys_from_s_znakom = ['msk' => 'Москва', 'tula' => 'Тула', 'abakan' => 'Абакан', 'arhangelsk' => 'Архангельск', 'astrahan' => 'Астрахань', 'barnaul' => 'Барнаул', 'belgorod' => 'Белгород', 'biysk' => 'Бийск', 'vladimir' => 'Владимир', 'volgograd' => 'Волгоград', 'vologda' => 'Вологда', 'voronezh' => 'Воронеж', 'gelendzhik' => 'Геленджик', 'ekaterinburg' => 'Екатеринбург', 'ivanovo' => 'Иваново', 'izhevsk' => 'Ижевск', 'irkutsk' => 'Иркутск', 'joshkar-ola' => 'Йошкар-Ола', 'kazan' => 'Казань', 'kaluga' => 'Калуга', 'kemerovo' => 'Кемерово', 'kirov' => 'Киров', 'kostroma' => 'Кострома', 'krasnodar' => 'Краснодар', 'kurgan' => 'Курган', 'kursk' => 'Курск', 'lipetsk' => 'Липецк', 'magnitogorsk' => 'Магнитогорск', 'murmansk' => 'Мурманск', 'naberezhnye-chelny' => 'Набережные челны', 'nizhnevartovsk' => 'Нижневартовск', 'nizhniy-novgorod' => 'Нижний Новгород', 'nizhniy-tagil' => 'Нижний Тагил', 'novokuznetsk' => 'Новокузнецк', 'novorossiysk' => 'Новороссийск', 'novosibirsk' => 'Новосибирск', 'omsk' => 'Омск', 'orel' => 'Орел', 'orenburg' => 'Оренбург', 'penza' => 'Пенза', 'perm' => 'Пермь', 'petrozavodsk' => 'Петрозаводск', 'pyatigorsk' => 'Пятигорск', 'rostov-na-dony' => 'Ростов-на-Дону', 'ryazan' => 'Рязань', 'samara' => 'Самара', 'saratov' => 'Саратов', 'sevastopol' => 'Севастополь', 'surgut' => 'Сургут', 'taganrog' => 'Таганрог', 'tambov' => 'Тамбов', 'tver' => 'Тверь', 'tolyatti' => 'Тольятти', 'tomsk' => 'Томск', 'tumen' => 'Тюмень', 'ulan-ude' => 'Улан-Удэ', 'ulyanovsk' => 'Ульяновск', 'ufa' => 'Уфа', 'habarovsk' => 'Хабаровск', 'cheboksary' => 'Чебоксары', 'abinsk' => 'Абинск', 'aznakaevo' => 'Азнакаево', 'azov' => 'Азов', 'yarcevo' => 'Ярцево', 'akademgorodok' => 'Академгородок', 'yaroslavl' => 'Ярославль', 'aldan' => 'Алдан', 'yarovoe' => 'Яровое', 'yalta' => 'Ялта', 'aleksandrov' => 'Александров', 'yakutsk' => 'Якутск', 'urga' => 'Юрга', 'ujnouralsk' => 'Южноуральск', 'ujnosahalinsk' => 'Южно-Сахалинск', 'aleksin' => 'Алексин', 'ubileyniy' => 'Юбилейный', 'alyshta' => 'Алушта', 'engels' => 'Энгельс', 'almetevsk' => 'Альметьевск', 'electrougli' => 'Электроугли', 'electrostal' => 'Электросталь', 'amurzet' => 'Амурзет', 'shelkovo' => 'Щёлково', 'amursk' => 'Амурск', 'shekino' => 'Щёкино', 'shushenskoe' => 'Шушенское', 'anadyir' => 'Анадырь', 'anapa' => 'Анапа', 'shimanovsk' => 'Шимановск', 'angarsk' => 'Ангарск', 'shelehov' => 'Шелехов', 'anzhero-sudzhensk' => 'Анжеро-Судженск', 'shahti' => 'Шахты', 'aniva' => 'Анива', 'shatura' => 'Шатура', 'anopino' => 'Анопино', 'sharya' => 'Шарья', 'apatityi' => 'Апатиты', 'shadrinsk' => 'Шадринск', 'apsheronsk' => 'Апшеронск', 'chusovoi' => 'Чусовой', 'aramil' => 'Арамиль', 'chita' => 'Чита', 'chehov' => 'Чехов', 'arzamas' => 'Арзамас', 'chernyahovsk' => 'Черняховск', 'armavir' => 'Армавир', 'chernuska' => 'Чернушка', 'armyansk' => 'Армянск', 'chernomorskoe' => 'Черноморское', 'arsenev' => 'Арсеньев', 'chernogorsk' => 'Черногорск', 'artyom' => 'Артём', 'chernogolovka' => 'Черноголовка', 'cherkessk' => 'Черкесск', 'asbest' => 'Асбест', 'cherepovec' => 'Череповец', 'astana' => 'Астана', 'cheremhovo' => 'Черемхово', 'atkarsk' => 'Аткарск', 'ahtubinsk' => 'Ахтубинск', 'chelyabinsk' => 'Челябинск', 'achinsk' => 'Ачинск', 'achit' => 'Ачит', 'chebarkul' => 'Чебаркуль', 'ashitkovo' => 'Ашитково', 'chapaevsk' => 'Чапаевск', 'balakovo' => 'Балаково', 'celina' => 'Целина', 'balaxna' => 'Балахна', 'hotkovo' => 'Хотьково', 'balashixa' => 'Балашиха', 'horol' => 'Хороль', 'balesino' => 'Балезино', 'himki' => 'Химки', 'barabash' => 'Барабаш', 'hantimansiysk' => 'Ханты-Мансийск', 'bataisk' => 'Батайск', 'belaya-kalitva' => 'Белая Калитва', 'furmanov' => 'Фурманов', 'belebei' => 'Белебей', 'fryazino' => 'Фрязино', 'fryazevo' => 'Фрязево', 'fokino' => 'Фокино', 'belovo' => 'Белово', 'feodosiya' => 'Феодосия', 'belogorsk' => 'Белогорск', 'uhta' => 'Ухта', 'ustlabinsk' => 'Усть-Лабинск', 'belokiryxa' => 'Белокуриха', 'ustkut' => 'Усть-Кут', 'beloomyt' => 'Белоомут', 'ustilimsk' => 'Усть-Илимск', 'beloreck' => 'Белорецк', 'ussuriyks' => 'Уссурийск', 'usolesibirskoe' => 'Усолье-Сибирское', 'belorechensk' => 'Белореченск', 'usinsk' => 'Усинск', 'uren' => 'Урень', 'beloyarskiy' => 'Белоярский', 'berdsk' => 'Бердск', 'sankt-piterburg' => 'Санкт-Петербург', 'berezniki' => 'Березники', 'beryozovskiy' => 'Берёзовский', 'beslan' => 'Беслан', 'birobidzhan' => 'Биробиджан', 'blagoveschensk' => 'Благовещенск', 'blagodarnyiy' => 'Благодарный', 'bobruysk' => 'Бобруйск', 'bogoroditsk' => 'Богородицк', 'bogorodsk' => 'Богородск', 'boguchar' => 'Богучар', 'bodaybo' => 'Бодайбо', 'bolshoy-kamen' => 'Большой Камень', 'bor' => 'Бор', 'borzya' => 'Борзя', 'borisoglebsk' => 'Борисоглебск', 'borovichi' => 'Боровичи', 'borovsk' => 'Боровск', 'bratsk' => 'Братск', 'bronnitsyi' => 'Бронницы', 'bryansk' => 'Брянск', 'bygylma' => 'Бугульма', 'budyonnovsk' => 'Будённовск', 'buzuluk' => 'Бузулук', 'valuyki' => 'Валуйки', 'vanino' => 'Ванино', 'vatytinki' => 'Ватутинки', 'velikie-luki' => 'Великие Луки', 'velikiy-novgorod' => 'Великий Новгород', 'velsk' => 'Вельск', 'vanev' => 'Венёв', 'verhniy-ufaley' => 'Верхний Уфалей', 'veshenskaya' => 'Вешенская', 'vidnoe' => 'Видное', 'vilyuchinsk' => 'Вилючинск', 'vitebsk' => 'Витебск', 'vladivostok' => 'Владивосток', 'vladikavkaz' => 'Владикавказ', 'volgodansk' => 'Волгодонск', 'volzhsk' => 'Волжск', 'volzhskiy' => 'Волжский', 'volokolamsk' => 'Волоколамск', 'volsk' => 'Вольск', 'vorkuta' => 'Воркута', 'voskresensk' => 'Воскресенск', 'votkinsk' => 'Воткинск', 'vyiborg' => 'Выборг', 'vyichegodskiy' => 'Вычегодский', 'vyishniy-volochyok' => 'Вышний Волочёк', 'vyasniki' => 'Вязники', 'vyazma' => 'Вязьма', 'gagarin' => 'Гагарин', 'gatchina' => 'Гатчина', 'georgievsk' => 'Георгиевск', 'glasov' => 'Глазов', 'gomel' => 'Гомель', 'gorbatov' => 'Горбатов', 'gorki-leninskie' => 'Горки Ленинские', 'gorno-altaisk' => 'Горно-Алтайск', 'goroxovec' => 'Гороховец', 'goryachiy-klyuch' => 'Горячий Ключ', 'groznyiy' => 'Грозный', 'grysi' => 'Грязи', 'gulkevich' => 'Гулькевичи', 'gus-hrustalnyiy' => 'Гусь Хрустальный', 'dalnegorsk' => 'Дальнегорск', 'dalnerechensk' => 'Дальнереченск', 'danilov' => 'Данилов', 'derbent' => 'Дербент', 'desnogorsk' => 'Десногорск', 'dzhankoy' => 'Джанкой', 'dzhubga' => 'Джубга', 'dzerzhinsk' => 'Дзержинск', 'dzerzhinskiy' => 'Дзержинский', 'dimitrovgrad' => 'Димитровград', 'dinskaya' => 'Динская', 'dmitrov' => 'Дмитров', 'dobryanka' => 'Добрянка', 'dolgoprudnyiy' => 'Долгопрудный', 'domodedovo' => 'Домодедово', 'donetsk' => 'Донецк', 'donskoy' => 'Донской', 'dybna' => 'Дубна', 'dyatkovo' => 'Дятьково', 'evpatoriya' => 'Евпатория', 'egorevsk' => 'Егорьевск', 'eysk' => 'Ейск', 'elabyga' => 'Елабуга', 'elec' => 'Елец', 'elisovo' => 'Елизово', 'elnya' => 'Ельня', 'essentuki' => 'Ессентуки', 'efremov' => 'Ефремов', 'zheleznovodsk' => 'Железноводск', 'zheleznogorsk' => 'Железногорск', 'zheleznogorsk-ilimskiy' => 'Железногорск-Илимский', 'zheleznodorozhnyiy' => 'Железнодорожный', 'zhigulyovsk' => 'Жигулёвск', 'zhukovka' => 'Жуковка', 'zhukovskiy' => 'Жуковский', 'zabaykalsk' => 'Забайкальск', 'zavodoukovsk' => 'Заводоуковск', 'zapolyarnyiy' => 'Заполярный', 'zaraysk' => 'Зарайск', 'zarechnyiy' => 'Заречный', 'zvenigorod' => 'Звенигород', 'zverevo' => 'Зверево', 'zelenogorsk' => 'Зеленогорск', 'zelenograd' => 'Зеленоград', 'zelenodolsk' => 'Зеленодольск', 'zelenokumsk' => 'Зеленокумск', 'zernograd' => 'Зерноград', 'zeya' => 'Зея', 'zima' => 'Зима', 'zlatoust' => 'Златоуст', 'zlyinka' => 'Злынка', 'ivanteevka' => 'Ивантеевка', 'igrim' => 'Игрим', 'izobilnyiy' => 'Изобильный', 'ilskiy' => 'Ильский', 'inza' => 'Инза', 'irbit' => 'Ирбит', 'iskitim' => 'Искитим', 'istra' => 'Истра', 'ishim' => 'Ишим', 'kalach-na-donu' => 'Калач-на-Дону', 'kaliningrad' => 'Калининград', 'kalininsk' => 'Калининск', 'kalyazin' => 'Калязин', 'kamensk-uralskiy' => 'Каменск-Уральский', 'kamensk-shahtinskiy' => 'Каменск-Шахтинский', 'kamyishin' => 'Камышин', 'kanash' => 'Канаш', 'kanevskaya' => 'Каневская', 'uray' => 'Урай', 'unecha' => 'Унеча', 'uzlovaya' => 'Узловая', 'ujur' => 'Ужур', 'uvarovo' => 'Уварово', 'uva' => 'Ува', 'syktyvkar' => 'Сыктывкар', 'tinda' => 'Тында', 'tutaev' => 'Тутаев', 'tuapce' => 'Туапсе', 'troick' => 'Троицк', 'tryohgorniy' => 'Трёхгорный', 'tobolsk' => 'Тобольск', 'tihoretsk' => 'Тихорецк', 'tihvin' => 'Тихвин', 'teikovo' => 'Тейково', 'syzran' => 'Сызрань', 'suhoj-log' => 'Сухой Лог', 'suhinichi' => 'Сухиничи', 'surovikino' => 'Суровикино', 'sudak' => 'Судак', 'stupino' => 'Ступино', 'strunino' => 'Струнино', 'tashtagol' => 'Таштагол', 'taman' => 'Тамань', 'talnah' => 'Талнах', 'talica' => 'Талица', 'tayshet' => 'Тайшет', 'ribnoe' => 'Рыбное', 'ribinsk' => 'Рыбинск', 'rusa' => 'Руза', 'rubzovo' => 'Рубцовск', 'rtischevo' => 'Ртищево', 'roschino' => 'Рощино', 'rostovvelikiy' => 'Ростов Великий', 'rostov' => 'Ростов', 'rossosh' => 'Россошь', 'rjev' => 'Ржев', 'reftinskiy' => 'Рефтинский', 'reutov' => 'Реутов', 'redkino' => 'Редкино', 'revda' => 'Ревда', 'ramenskoe' => 'Раменское', 'raichinsk' => 'Райчихинск', 'radujniy' => 'Радужный', 'sosenskij' => 'Сосенский', 'sosnovyj-bor' => 'Сосновый Бор', 'sochi' => 'Сочи', 'spassk-rjazanskij' => 'Спасск-Рязанский', 'stavropol' => 'Ставрополь', 'starica' => 'Старица', 'sterlitamak' => 'Стерлитамак', 'strezhevoj' => 'Стрежевой', 'staryj-oskol' => 'Старый Оскол', 'pityah' => 'Пыть-Ях', 'pushkino' => 'Пушкино', 'pugachev' => 'Пугачёв', 'pskov' => 'Псков', 'prohladniy' => 'Прохладный', 'protvino' => 'Протвино', 'proletarsk' => 'Пролетарск', 'prokopievsk' => 'Прокопьевск', 'poronaysk' => 'Поронайск', 'polyarniezori' => 'Полярные Зори', 'polisaevo' => 'Полысаево', 'polevskoy' => 'Полевской', 'pokrov' => 'Покров', 'podolsk' => 'Подольск', 'pitkyantra' => 'Питкяранта', 'pikalevo' => 'Пикалёво', 'pechora' => 'Печора', 'petropavlovskkamchatskiy' => 'Петропавловск-Камчатский', 'petrodvorec' => 'Петродворец', 'snezhinsk' => 'Снежинск', 'snezhnogorsk' => 'Снежногорск', 'sovetsk' => 'Советск', 'sovetskaja-gavan' => 'Советская Гавань', 'sovetskij' => 'Советский', 'solikamsk' => 'Соликамск', 'solnechnogorsk' => 'Солнечногорск', 'solnechnodolsk' => 'Солнечнодольск', 'sorochinsk' => 'Сорочинск', 'sortavala' => 'Сортавала', 'petrovskzabaykalskiy' => 'Петровск-Забайкальский', 'pestovo' => 'Пестово', 'perevoz' => 'Перевоз', 'pervouralsk' => 'Первоуральск', 'pervomayskoe' => 'Первомайское', 'pangodi' => 'Пангоды', 'palasovka' => 'Палласовка', 'pavlofedorovka' => 'Павло-Федоровка', 'pavlovskiyposad' => 'Павловский Посад', 'pavlovskiy' => 'Павловская', 'pavlovsk' => 'Павловск', 'pavlovo' => 'Павлово', 'oha' => 'Оха', 'pstrogojsk' => 'Острогожск', 'orsk' => 'Орск', 'orehovozuevo' => 'Орехово-Зуево', 'opochka' => 'Опочка', 'olenegorsk' => 'Оленегорск', 'oktyabrskiy' => 'Октябрьский', 'ozery' => 'Озёры', 'ozersk' => 'Озёрск', 'odincovo' => 'Одинцово', 'obninsk' => 'Обнинск', 'nyagan' => 'Нягань', 'nurlat' => 'Нурлат', 'noyabrsk' => 'Ноябрьск', 'norilsk' => 'Норильск', 'nogliki' => 'Ноглики', 'noginsk' => 'Ногинск', 'noviyurengoy' => 'Новый Уренгой', 'noviyoskol' => 'Новый Оскол', 'novocherkassk' => 'Новочеркасск', 'novouralsk' => 'Новоуральск', 'novouzenzk' => 'Новоузенск', 'novotroick' => 'Новотроицк', 'novotitarovskaya' => 'Новотитаровская', 'novomosskovsk' => 'Новомосковск', 'magadan' => 'Магадан', 'novokuybisjevsk' => 'Новокуйбышевск', 'novokuzneck' => 'Новокузнецк', 'maykop' => 'Майкоп', 'novokubansk' => 'Новокубанск', 'salavat' => 'Салават', 'salehard' => 'Салехард', 'salsk' => 'Сальск', 'saraktash' => 'Саракташ', 'saransk' => 'Саранск', 'sarov' => 'Саров', 'satka' => 'Сатка', 'sajanogorsk' => 'Саяногорск', 'svirsk' => 'Саяногорск', 'svobodnyj' => 'Свободный', 'severobajkalsk' => 'Северобайкальск', 'severodvinsk' => 'Северодвинск', 'severomorsk' => 'Североморск', 'seversk' => 'Северск', 'severskaja' => 'Северская', 'segezha' => 'Сегежа', 'sergach' => 'Сергач', 'sengilej' => 'Сенгилей', 'sergiev-posad' => 'Сергиев Посад', 'serpuhov' => 'Серпухов', 'sertolovo' => 'Сертолово', 'sibaj' => 'Сибай', 'simferopol' => 'Симферополь', 'smolensk' => 'Смоленск', 'slavjansk-na-kubani' => 'Славянск-на-Кубани', 'novodvinsk' => 'Новодвинск', 'mayskiy' => 'Майский', 'novoaleksandrovsk' => 'Новоалександровск', 'novachara' => 'Новая Чара', 'makarov' => 'Макаров', 'maloyaroslavets' => 'Малоярославец', 'novurengoy' => 'Нов. Уренгой', 'mama' => 'Мама', 'mahachkala' => 'Махачкала', 'nikolaevsknaamure' => 'Николаевск-на-Амуре', 'megion' => 'Мегион', 'megdurechensk' => 'Междуреченск', 'meleuz' => 'Мелеуз', 'miass' => 'Миасс', 'millerovo' => 'Миллерово', 'nijneudinsk' => 'Нижнеудинск', 'nijnikamsk' => 'Нижнекамск', 'mineralnie-vodi' => 'Минеральные Воды', 'minusinsk' => 'Минусинск', 'nijegorodskaya' => 'Нижегородская', 'mirniy' => 'Мирный', 'mihaylovka' => 'Михайловка', 'mogilev' => 'Могилев', 'mogocha' => 'Могоча', 'nefteugansk' => 'Нефтеюганск', 'mogga' => 'Можга', 'mozdok' => 'Моздок', 'monchegorsk' => 'Мончегорск', 'morozovsk' => 'Морозовск', 'morshansk' => 'Моршанск', 'moskovskiy' => 'Московский', 'muravlenko' => 'Муравленко', 'mtsensk' => 'Мценск', 'mitishchi' => 'Мытищи', 'neftecamsk' => 'Нефтекамск', 'nerungri' => 'Нерюнгри', 'nekrasovskoe' => 'Некрасовское', 'nevinomssk' => 'Невинномысск', 'nahodka' => 'Находка', 'narofominsk' => 'Наро-Фоминск', 'nalchik' => 'Нальчик', 'nadim' => 'Надым', 'luberci' => 'Люберцы', 'lyubertsi' => 'Люберцы', 'litkarino' => 'Лыткарино', 'lisva' => 'Лысьва', 'luhovitsi' => 'Луховицы', 'luza' => 'Луза', 'luga' => 'Луга', 'losino-petrovskiy' => 'Лосино-Петровский', 'loknya' => 'Локня', 'lodeynoepole' => 'Лодейное Поле', 'lobnya' => 'Лобня', 'lobachev' => 'Лобачев', 'liski' => 'Лиски', 'likino-dulyovo' => 'Ликино-Дулёво', 'lesosibirsk' => 'Лесосибирск', 'lesnoy' => 'Лесной', 'lermontov' => 'Лермонтов', 'lensk' => 'Ленск', 'leninsk-kuznetskiy' => 'Ленинск-Кузнецкий', 'leninogorsk' => 'Лениногорск', 'leningradskaya' => 'Ленинградская', 'labitnangi' => 'Лабытнанги', 'labinsk' => 'Лабинск', 'kansk' => 'Канск', 'karachaevsk' => 'Карачаевск', 'kargat' => 'Каргат', 'kasimov' => 'Касимов', 'kachkanar' => 'Качканар', 'kashira' => 'Кашира', 'kerch' => 'Керчь', 'kizlyar' => 'Кизляр', 'kingisepp' => 'Кингисепп', 'kineshma' => 'Кинешма', 'kirensk' => 'Киренск', 'kirgach' => 'Киржач', 'kirovo-chepetsk' => 'Кирово-Чепецк', 'kirovsk' => 'Кировск', 'kiselyovsk' => 'Киселёвск', 'kislovodsk' => 'Кисловодск', 'klin' => 'Клин', 'klintsi' => 'Клинцы', 'kovrov' => 'Ковров', 'kogalim' => 'Когалым', 'kokoshkino' => 'Кокошкино', 'kolomna' => 'Коломна', 'kolpino' => 'Колпино', 'kolchugino' => 'Кольчугино', 'komsomolsk-na-amure' => 'Комсомольск-на-Амуре', 'konakovo' => 'Конаково', 'kondopoga' => 'Кондопога', 'kondrovo' => 'Кондрово', 'kopeysk' => 'Копейск', 'korablino' => 'Кораблино', 'korenovsk' => 'Кореновск', 'korolyov' => 'Королёв', 'korsakov' => 'Корсаков', 'kotelniki' => 'Котельники', 'kotlas' => 'Котлас', 'krasnoarmeysk' => 'Красноармейск', 'krasnogvardeysk' => 'Красногвардейск', 'krasnogorsk' => 'Красногорск', 'krasnoe-selo' => 'Красное Село', 'krasnokamensk' => 'Краснокаменск', 'krasnoperekopsk' => 'Красноперекопск', 'krasnoturinsk' => 'Краснотурьинск', 'krasnoufimsk' => 'Красноуфимск', 'krasniy-sulin' => 'Красный Сулин', 'krichev' => 'Кричев', 'kropotkin' => 'Кропоткин', 'krimsk' => 'Крымск', 'kstovo' => 'Кстово', 'kubinka' => 'Кубинка', 'kuznetsk' => 'Кузнецк', 'kulebaki' => 'Кулебаки', 'kuloy' => 'Кулой', 'kumertau' => 'Кумертау', 'kungur' => 'Кунгур', 'kurilsk' => 'Курильск', 'kushchevskaya' => 'Кущевская', 'kizil' => 'Кызыл'];

        $citys_from_rach_com = include Yii::getAlias('@app/files/city_from_rach_com.php');

        foreach ($citys_from_s_znakom as $key => $city) {

            foreach ($citys_from_rach_com as $city_znakom) {

                if ($city == $city_znakom['value']) {

                    $city_class = new City();

                    $city_class->url = $key;
                    $city_class->city = $city;
                    $city_class->city2 = $city_znakom['value2'];
                    $city_class->city3 = $city_znakom['value3'];

                    $city_class->save();


                }

            }
        }
    }
}