<?php
namespace frontend\controllers;

use frontend\components\MetaBuilder;
use frontend\modules\user\models\Profile;
use Yii;
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
        $posts = Profile::find()->where(['city' => $city])->limit(Yii::$app->params['post_limit'] )->with('userAvatarRelations');

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

        Yii::$app->view->title = MetaBuilder::Build(Yii::$app->request->url, $city, 'Title');

        return $this->render('index', [
            'city' => $city,
            'posts' => $posts
        ]);
    }

    public function actionAgree()
    {
        return $this->render('agree');
    }
}
