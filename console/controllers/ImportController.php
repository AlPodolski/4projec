<?php


namespace console\controllers;

use common\models\Alcogol;
use common\models\City;
use common\models\Education;
use common\models\Haracter;
use common\models\Interesting;
use common\models\IntimHair;
use common\models\LifeGoals;
use common\models\Metro;
use common\models\Place;
use common\models\Pol;
use common\models\Rayon;
use common\models\Smoking;
use common\models\Vneshnost;
use frontend\models\relation\UserAlcogol;
use frontend\models\relation\UserEducation;
use frontend\models\relation\UserHaracter;
use frontend\models\relation\UserIntimHair;
use frontend\models\relation\UserLifeGoals;
use frontend\models\relation\UserSmoking;
use frontend\models\relation\UserZnakomstva;
use frontend\models\UserInteresting;
use frontend\models\UserPol;
use frontend\models\UserPrice;
use frontend\models\UserProstitutki;
use frontend\models\UserService;
use frontend\models\UserToMetro;
use frontend\models\UserToPlace;
use frontend\models\UserToRayon;
use frontend\models\UserVes;
use frontend\models\UserVneshnost;
use frontend\modules\user\models\Photo;
use Yii;
use yii\console\Controller;
use League\Csv\Reader;
use League\Csv\Statement;
use frontend\modules\user\models\Profile;
use frontend\models\UserHairColor;
use yii\helpers\ArrayHelper;
use common\models\Service;

class ImportController extends Controller
{
    public function actionIndex()
    {

        $stream = \fopen(Yii::getAlias('@app/files/content.csv'), 'r');

        $csv = Reader::createFromStream($stream);
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);

        //build a statement
        $stmt = (new Statement());

        $city = City::find()->asArray()->all();

        $records = $stmt->process($csv);

        $i = 0;

        foreach ($records as $record) {

            foreach ($city as $item) {

                if ($item['city'] == $record['city']) {

                    $user = new Profile();

                    $user->username = $record['name'];
                    $user->password_hash = Yii::$app->security->generateRandomString(60);
                    $user->auth_key = Yii::$app->security->generateRandomString();
                    $user->email = 'admin@mail.com'.$i;
                    $user->status = 10;
                    $user->created_at = $time = \time();
                    $user->updated_at = $time;
                    $user->verification_token = Yii::$app->security->generateRandomString(43);
                    $user->city = $item['url'];
                    $user->birthday = \time() - ($record['age'] * 3600 * 24 * 365) + \rand(0, 3600 * 24 * \rand(1, 365));
                    $i++;
                    if ($user->save()) {



                       $userPol = new UserPol();
                       $userPol->user_id = $user->id;
                       $userPol->pol_id = 2;

                       $userPol->save();

                        if ($record['volosi']) {

                            $userHair = new UserHairColor();
                            $userHair->user_id = $user->id;

                            if ($record['volosi'] == 'Брюнетка' or $record['volosi'] == 'Шатенка') {
                                $userHair->value = 2;
                            }
                            if ($record['volosi'] == 'Блондинка') {
                                $userHair->value = 1;
                            }
                            if ($record['volosi'] == 'Рыжая') {
                                $userHair->value = 3;
                            }

                            $userHair->save();

                        }

                        if ($record['price']) {

                            if (\rand(1, 5) != 3) {

                                $userPrice = new UserPrice();

                                $userPrice->user_id = $user->id;
                                $userPrice->value = $record['price'];

                                $userPrice->save();

                                $userPr = new UserProstitutki();

                                $userPr->user_id = $user->id;
                                $userPr->param_id = 1;

                                $userPr->save();

                            } else {
                                $userZnakom = new UserZnakomstva();
                                $userZnakom->user_id = $user->id;
                                $userZnakom->param_id = 1;
                            }

                        }

                        if ($record['ves']) {

                            $userVes = new UserVes();

                            $userVes->user_id = $user->id;
                            $userVes->value = $record['ves'];

                            $userVes->save();

                        }

                        if ($record['photo_mii']) {

                            $userPhoto = new Photo();

                            $userPhoto->user_id = $user->id;
                            $userPhoto->file = \str_replace('files', '/files/uploads/aaa', $record['photo_mii']);
                            $userPhoto->avatar = 1;

                            $userPhoto->save();

                        }

                        if ($record['gal']) {


                            $gall = \explode('/', $record['gal']);

                            if ($gall) {

                                foreach ($gall as $gallitem) {

                                    $userPhoto = new Photo();

                                    $userPhoto->user_id = $user->id;
                                    $userPhoto->file = \str_replace('files', '/files/uploads/aaa', $record['photo_mii']);
                                    $userPhoto->avatar = 0;

                                    $userPhoto->save();

                                }

                            }

                        }

                    }

                }

            }

        }

        echo $i;
    }

    public function actionPropPr()
    {

        $profiles = Profile::find()->asArray()->all();

        foreach ($profiles as $profile) {

            $rayon = $this->addRayon($profile['city'], $profile['id']);
            $this->addMetro($profile['city'], $profile['id'], $rayon);
            $this->addService($profile['city'], $profile['id']);
            $this->addCeli($profile['city'], $profile['id']);
            $this->addSmoke($profile['city'], $profile['id']);
            $this->addAlcohol($profile['city'], $profile['id']);
            $this->addObrazovanie($profile['city'], $profile['id']);
            $this->addIntimHair($profile['city'], $profile['id']);
            $this->addInteresy($profile['city'], $profile['id']);
            $this->addHaracter($profile['city'], $profile['id']);
            $this->addVneshnost($profile['city'], $profile['id']);
            $this->addMestoVstreji($profile['city'], $profile['id']);

        }

    }

    private function addRayon($city, $user_id)
    {

        if ($rayon = Rayon::find()->where(['city' => $city])->asArray()->all()) {

            $user_to_raton = new UserToRayon();
            $user_to_raton->user_id = $user_id;
            $user_to_raton->rayon_id = ArrayHelper::getValue($return_rayon = $rayon[\array_rand($rayon)], 'id');

            if ($user_to_raton->save()) return $return_rayon;

        }

    }

    public function addMetro($city_user = 'msk', $user_id = 1, $rayon = false)
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

                if ($rayon['value'] == $record['rayon']) {

                    if ($dostypnoe_metro = \explode(',', $record['metro'])) {

                        if ($metro = Metro::find()->where(['city' => $city_user])->andWhere(['value'=> $dostypnoe_metro[\array_rand($dostypnoe_metro)]])->asArray()->one()){

                            $user_to_metro = new UserToMetro();
                            $user_to_metro->user_id = $user_id;
                            $user_to_metro->metro_id = $metro['id'];

                            $user_to_metro->save();

                        }

                    }

                }

            }

        }else{
            if ($metro = Metro::find()->where(['city' => $city_user])->asArray()->all()){

                $user_to_metro = new UserToMetro();
                $user_to_metro->user_id = ArrayHelper::getValue($metro[\array_rand($metro)], 'id');
                $user_to_metro->metro_id = $metro['id'];

                $user_to_metro->save();

            }
        }


    }

    public function addService($city = 'msk', $user_id = 1){

        if($service = Service::find()->asArray()->all()){

            foreach ($service as $item){

                if(\rand(0,2) != 2){

                    $user_place = new UserService();
                    $user_place->user_id = $user_id;
                    $user_place->service_id = $item['id'];

                    $user_place->save();

                }

            }

        }



    }

    public function addCeli($city = 'msk', $user_id = 1){

        if($service = LifeGoals::find()->asArray()->all()){

            foreach ($service as $item){

                if(\rand(0,2) != 2){

                    $user_place = new UserLifeGoals();
                    $user_place->user_id = $user_id;
                    $user_place->param_id = $item['id'];

                    $user_place->save();

                }

            }

        }



    }

    public function addSmoke($city = 'msk', $user_id = 1){

        if($service = Smoking::find()->asArray()->all()){

                    $user_place = new UserSmoking();
                    $user_place->user_id = $user_id;
                    $user_place->param_id = ArrayHelper::getValue($service[\array_rand($service)], 'id');

                    $user_place->save();

        }

    }

    public function addAlcohol($city = 'msk', $user_id = 1){

        if($service = Alcogol::find()->asArray()->all()){

                    $user_place = new UserAlcogol();
                    $user_place->user_id = $user_id;
                    $user_place->param_id = ArrayHelper::getValue($service[\array_rand($service)], 'id');

                    $user_place->save();

        }

    }

    public function addObrazovanie($city = 'msk', $user_id = 1){

        if($service = Education::find()->asArray()->all()){

                    $user_place = new UserEducation();
                    $user_place->user_id = $user_id;
                    $user_place->param_id = ArrayHelper::getValue($service[\array_rand($service)], 'id');

                    $user_place->save();

        }

    }

    public function addIntimHair($city = 'msk', $user_id = 1){

        if($service = IntimHair::find()->asArray()->all()){

                    $user_place = new UserIntimHair();
                    $user_place->user_id = $user_id;
                    $user_place->param_id = ArrayHelper::getValue($service[\array_rand($service)], 'id');

                    $user_place->save();

        }

    }

    public function addInteresy($city = 'msk', $user_id = 1){

        if($service = Interesting::find()->asArray()->all()){

            foreach ($service as $item){

                if(\rand(0,2) != 2){

                    $class = new UserInteresting();
                    $class->user_id = $user_id;
                    $class->param_id = $item['id'];

                    $class->save();

                }

            }

        }

    }

    public function addHaracter($city = 'msk', $user_id = 1){

        if($service = Haracter::find()->asArray()->all()){

            foreach ($service as $item){

                if(\rand(0,3) != 3){

                    $class = new UserHaracter();
                    $class->user_id = $user_id;
                    $class->param_id = $item['id'];

                    $class->save();

                }

            }

        }

    }

    public function addVneshnost($city = 'msk', $user_id = 1){

        if($service = Vneshnost::find()->asArray()->all()){

            $service = $service[\array_rand($service)];

            $class = new UserVneshnost();
            $class->user_id = $user_id;
            $class->param_id = $service['id'];
            $class->save();

        }

    }

    public function addMestoVstreji($city = 'msk', $user_id = 1){

        if($mesto = Place::find()->asArray()->all()){

            foreach ($mesto as $mestoItem){

                if(\rand(0,1) == 1){

                    $user_place = new UserToPlace();
                    $user_place->user_id = $user_id;
                    $user_place->place_id = $mestoItem['id'];

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