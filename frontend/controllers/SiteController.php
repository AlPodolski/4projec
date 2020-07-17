<?php
namespace frontend\controllers;

use frontend\models\forms\FeedBackForm;
use frontend\models\Meta;
use frontend\components\MetaBuilder;
use frontend\modules\user\models\Profile;
use Yii;
use yii\web\Controller;
use frontend\modules\user\components\AuthHandler;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\SessionsClient;

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
            ->orderBy(['fake' => SORT_DESC, 'sort' => SORT_DESC])->with('userAvatarRelations');

        if (Yii::$app->request->isPost){

            $posts->offset(Yii::$app->params['post_limit'] * Yii::$app->request->post('page'));

            $posts = $posts->all();

            foreach ($posts as $post){

                echo $this->renderFile('@app/views/layouts/article.php', [
                    'post' => $post
                ]);

            }

            exit();

        }

        $posts = $posts->all();

        $title =  MetaBuilder::Build(Yii::$app->request->url, $city, 'Title');
        $des = MetaBuilder::Build(Yii::$app->request->url, $city, 'des');
        $h1 = MetaBuilder::Build(Yii::$app->request->url, $city, 'h1');

        $yandex_meta = Meta::find()->where(['city' => $city])->asArray()->one();

        return $this->render('index', [
            'city' => $city,
            'posts' => $posts,
            'title' => $title,
            'des' => $des,
            'h1' => $h1,
            'yandex_meta' => $yandex_meta,
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

        try {

            $socket = fsockopen(Yii::$app->params['websoket_addr_with_not_port_and_protocol'], Yii::$app->params['websoket_post']);

            \Ratchet\Client\connect(Yii::$app->params['websoket_addr'])->then(function($conn, $param  = 2) {

                $result = array(
                    'present_id' => $param,
                    'action' => 'sendPresent',
                );

                $result = \json_encode($result);

                echo $result;

                $conn->send($result);

            }, function ($e) {
                echo "Could not connect: {$e->getMessage()}\n";
            });


        }catch (yii\base\ErrorException $exception){

            echo $exception->getMessage();

        }

    }

}
