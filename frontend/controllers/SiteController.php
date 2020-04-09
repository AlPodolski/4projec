<?php
namespace frontend\controllers;

use common\models\City;
use frontend\components\helpers\MetaFilterHelper;
use frontend\components\MetaBuilder;
use frontend\models\UserPol;
use frontend\modules\user\models\Friends;
use frontend\modules\user\models\Profile;
use Yii;
use yii\redis\Connection;
use yii\web\Controller;

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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($city)
    {

        $posts = Profile::find()->where(['city' => $city])->limit(Yii::$app->params['post_limit'] )->orderBy(['rand()' => SORT_DESC])->with('userAvatarRelations');

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

        return $this->render('index', [
            'city' => $city,
            'posts' => $posts,
            'title' => $title,
            'des' => $des,
            'h1' => $h1,
        ]);
    }

    public function actionAgree()
    {
        return $this->render('agree');
    }

    public function actionCust(){

        $friends = new Friends();
        $friends->user_id = '20827';
        $friends->friend_user_id = '23215';

        $friends->save();

    }
}
