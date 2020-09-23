<?php


namespace frontend\controllers;

use common\models\City;
use frontend\components\helpers\MetaFilterHelper;
use frontend\components\MetaBuilder;
use frontend\modules\user\components\behavior\LastVisitTimeUpdate;
use frontend\modules\user\components\helpers\QueryParamsHelper;
use frontend\modules\user\models\Profile;
use Yii;
use yii\web\Controller;

class FilterController extends Controller
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

    public function actionIndex($city, $param, $page = false)
    {

        $query_params = QueryParamsHelper::getParams($param, $city);

        $posts = '';

        $cityInfo = City::getCity(Yii::$app->controller->actionParams['city']);

        if (!empty($query_params)){

            $posts = Profile::find();

            foreach ($query_params as $item){

                $posts->andWhere($item);

            }

            $posts = $posts->limit(Yii::$app->params['post_limit'])
                ->andWhere(['!=',  'email' ,  'adminadultero@mail.com'])
                ->orderBy(['last_visit_time' => SORT_DESC])
                ->with('userAvatarRelations');

            if ($page) $posts = $posts->offset(Yii::$app->params['post_limit'] * 1);

            if (Yii::$app->request->isPost){

                $page = Yii::$app->request->post('page') + 1;

                echo '<div data-url="/'.$param.'/page-'.$page.'" class="col-12"></div>';

                $posts->offset(Yii::$app->params['post_limit'] * Yii::$app->request->post('page'));

                $posts = $posts->all();

                foreach ($posts as $post){

                    echo $this->renderFile('@app/views/layouts/article.php', [
                        'post' => $post,
                        'cityInfo' => $cityInfo,
                    ]);

                }

                exit();

            }

            $posts = $posts->all();


        }

        $more_posts = false;

        if(\count($posts) < 4) $more_posts = Profile::find()->limit(8)
            ->all();

        $title = MetaFilterHelper::Filter( MetaBuilder::Build(Yii::$app->request->url, $city, 'Title'));
        $des = MetaFilterHelper::Filter(MetaBuilder::Build(Yii::$app->request->url, $city, 'des'));
        $h1 = MetaFilterHelper::Filter(MetaBuilder::Build(Yii::$app->request->url, $city, 'h1'));

        return $this->render('index', [
            'posts' => $posts,
            'city' => $city,
            'param' => $param,
            'title' => $title,
            'des' => $des,
            'h1' => $h1,
            'cityInfo' => $cityInfo,
            'more_posts' => $more_posts,
        ]);
    }
}