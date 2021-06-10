<?php
namespace frontend\controllers;

use common\models\City;
use frontend\components\helpers\PromoHelper;
use frontend\components\service\advertisin\AdvertisingService;
use frontend\models\forms\FeedBackForm;
use frontend\models\Meta;
use frontend\components\MetaBuilder;
use frontend\modules\chat\models\forms\SendMessageForm;
use frontend\modules\group\models\forms\addGroupRecordItemForm;
use frontend\modules\user\components\behavior\LastVisitTimeUpdate;
use frontend\modules\user\models\Profile;
use Yii;
use yii\web\Controller;
use frontend\modules\user\components\AuthHandler;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
           LastVisitTimeUpdate::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'auth' => [
                'class' => 'frontend\components\AuthAction',
                'city' => Yii::$app->controller->actionParams['city'],
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'thumb' => 'iutbay\yii2imagecache\ThumbAction',
        ];
    }

    public function onAuthSuccess($client)
    {
        (new AuthHandler($client))->handle();
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($city , $page = false)
    {

        $posts = Profile::find()->where(['city' => $city])->limit(Yii::$app->params['post_limit'] )
            ->andWhere(['!=',  'email' ,  'adminadultero@mail.com'])
            ->andWhere(['!=',  'email' ,  'adminadultgai@mail.com'])
            ->orderBy(['last_visit_time' => SORT_DESC])
            ->with('userAvatarRelations');

        if ($promoPostId = Yii::$app->request->get('id')){

            $posts = $posts->andWhere(['<>', 'id', $promoPostId]);

        }

        if ($page) $posts = $posts->offset(Yii::$app->params['post_limit'] * 1);

        $cityInfo = City::getCity(Yii::$app->controller->actionParams['city']);

        if (Yii::$app->request->isPost){

            $posts->offset(Yii::$app->params['post_limit'] * Yii::$app->request->post('page'));

            $posts = $posts->all();

            $page = Yii::$app->request->post('page') + 1;

            if ($posts) echo '<div data-url="/page-'.$page.'" class="col-12"></div>';

            foreach ($posts as $post){

                echo $this->renderFile('@app/views/layouts/article.php', [
                    'post' => $post,
                    'cityInfo' => $cityInfo,
                    'cssClass' => 'col-6 col-sm-6 col-md-4 col-lg-3',
                ]);

            }

            exit();

        }

        $posts = $posts->all();

        if($promoPostId = Yii::$app->request->get('id') and Yii::$app->request->get('promo')) {

            PromoHelper::addCookie();

            $promoPost = Profile::find()->where(['id' => $promoPostId])
                ->limit(1)
                ->with('userAvatarRelations')
                ->one();

            if ($posts){

                array_shift($posts);

                array_unshift($posts, $promoPost);

            }

        }

        $uri = Yii::$app->request->url;

        if (\strpos($uri, '?')) $uri = \strstr($uri, '?', true);

        $title =  MetaBuilder::Build($uri, $city, 'Title');
        $des = MetaBuilder::Build($uri, $city, 'des');
        $h1 = MetaBuilder::Build($uri, $city, 'h1');

        $yandex_meta = Meta::find()->where(['city' => $city])->asArray()->one();

        Yii::$app->params['h1'] = $h1;

        return $this->render('index', [
            'city' => $city,
            'posts' => $posts,
            'title' => $title,
            'des' => $des,
            'h1' => $h1,
            'yandex_meta' => $yandex_meta,
            'cityInfo' => $cityInfo,
        ]);
    }

    public function actionFeedBack()
    {
        if (Yii::$app->request->isPost){

            if ( !$_POST['g-recaptcha-response'] ) {

                Yii::$app->session->setFlash('warning' , 'Сообщение не отправлено, нужно заполнить капчу');

                Yii::$app->response->redirect(['/'], 301, false);

                return true;
            }


            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $key = Yii::$app->params['recaptcha-key'];
            $query = $url.'?secret='.$key.'&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR'];

            $data = json_decode(file_get_contents($query));

            if ( $data->success == false) {

                Yii::$app->session->setFlash('warning' , 'Сообщение не отправлено, капча введена неверно');

                Yii::$app->response->redirect(['/'], 301, false);

                return true;


            }


            $model = new FeedBackForm();

            if ($model->load(Yii::$app->request->post()) and $model->save()){

                Yii::$app->session->setFlash('success' , 'Сообщение отправлено');

                Yii::$app->response->redirect(['/'], 301, false);

            }

        }

        Yii::$app->response->redirect(['/'], 301, false);


    }

    public function actionAgree($city)
    {
        return $this->render('agree');
    }

    public function actionRobot($city)
    {
        $host = $city.'.'.Yii::$app->params['site_name'];

        return $this->renderFile('@app/views/site/robot.php', [
            'host' => $host
        ]);
    }

    public function actionCust(){

        $cookies = Yii::$app->request->cookies;

        \d($cookies['chat_info']);

        if (isset($cookies['chat_info'])){

            $data = \json_decode($cookies['chat_info']->value);

            $model = new SendMessageForm();

            $model->from_id = $data[0]->profile_id;
            $model->created_at = \time();
            $model->text = Yii::$app->params['invitation_message'];
            $model->user_id = 28896;

            if ($model->validate() and $chat_id = $model->save()){

                $userMessage = new SendMessageForm();

                $userMessage->from_id = 28896;
                $userMessage->created_at = \time();
                $userMessage->text = $data['message'];
                $userMessage->chat_id = $chat_id;

                //$cookies->remove('chat_info');

                if ($userMessage->save()) return $this->redirect('/chat');



            }

            \d($model->getErrors());


        }


    }

    public function actionGetFeedBackForm()
    {
        echo \frontend\widgets\FeedBackFormWidget::widget();
        exit();
    }

    public function actionAdvertising($city)
    {

        return true;

        $cityInfo = City::getCity($city);

        if ($city == 'msk') return false;

        if (Yii::$app->user->identity->role == 'admin') return null;

        $ipData =  unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));

        if (!$ipData or $ipData['geoplugin_countryCode'] == 'UA') return false;

        $posts = AdvertisingService::getAdvertising($city);

        if (Yii::$app->user->isGuest) $css = 'col-6 col-sm-6 col-md-4 col-lg-3';
        else $css = 'col-6 col-sm-6 col-md-4 col-lg-4';

        if ($posts){

            echo $this->renderFile('@app/views/layouts/article-adv.php', [
                'post' => $posts[\array_rand($posts)],
                'cityInfo' => $cityInfo,
                'city' => $city,
                'cssClass' => $css,
                'type' => 'advertising'
            ]);

            exit();

        }

        return false;

    }

}
