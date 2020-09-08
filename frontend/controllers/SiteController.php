<?php
namespace frontend\controllers;

use common\models\City;
use frontend\models\forms\FeedBackForm;
use frontend\models\Meta;
use frontend\components\MetaBuilder;
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
    public function actionIndex($city)
    {
        $posts = Profile::find()->where(['city' => $city])->limit(Yii::$app->params['post_limit'] )
            ->andWhere(['!=',  'email' ,  'adminadultero@mail.com'])
            ->orderBy(['last_visit_time' => SORT_DESC])
            ->with('userAvatarRelations');

        $cityInfo = City::getCity(Yii::$app->controller->actionParams['city']);

        if (Yii::$app->request->isPost){

            $posts->offset(Yii::$app->params['post_limit'] * Yii::$app->request->post('page'));

            $posts = $posts->all();

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

        $title =  MetaBuilder::Build(Yii::$app->request->url, $city, 'Title');
        $des = MetaBuilder::Build(Yii::$app->request->url, $city, 'des');
        $h1 = MetaBuilder::Build(Yii::$app->request->url, $city, 'h1');

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

        $item = new addGroupRecordItemForm();

        $item->class = 'frontend\modules\group\models\Group';
        $item->user_id = 23215;
        $item->group_id = 2;
        $item->text = 'frontend\modules\group\models\Group';

        $item->save();


    }

}
