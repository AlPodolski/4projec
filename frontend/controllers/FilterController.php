<?php


namespace frontend\controllers;

use frontend\components\MetaBuilder;
use frontend\models\Posts;
use frontend\modules\user\components\helpers\QueryParamsHelper;
use frontend\modules\user\models\Profile;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class FilterController extends Controller
{
    public function actionIndex($city, $param)
    {
        $query_params = QueryParamsHelper::getParams($param);

        $posts = '';

        if (!empty($query_params)){

            $posts = Profile::find();

            foreach ($query_params as $item){

                $posts->andWhere($item);

            }

            $posts = $posts->limit(12)->with('userAvatarRelations')->all();

        }

        $more_posts = false;

        if(\count($posts) < 4) $more_posts = Profile::find()->limit(8)
            ->all();

        $title = MetaBuilder::Build(Yii::$app->request->url, $city, 'Title');
        $des = MetaBuilder::Build(Yii::$app->request->url, $city, 'des');
        $h1 = MetaBuilder::Build(Yii::$app->request->url, $city, 'h1');

        return $this->render('index', [
            'posts' => $posts,
            'city' => $city,
            'param' => $param,
            'pages' => $pages,
            'title' => $title,
            'des' => $des,
            'h1' => $h1,
            'more_posts' => $more_posts,
        ]);
    }
}