<?php


namespace frontend\controllers;

use frontend\models\Posts;
use frontend\modules\user\models\Profile;
use yii\data\Pagination;
use yii\web\Controller;

class FilterController extends Controller
{
    public function actionIndex($city, $param)
    {
        $query_params = Profile::getByParams( $param);

        $posts = '';
        $pages = null;

        if (!empty($query_params)){

            $posts = Profile::find();

            foreach ($query_params as $item){

                $posts->andWhere($item);

            }

            $countQuery = clone $posts;

            $pages = new Pagination(['totalCount' => $countQuery->count()]);

            $posts = $posts->offset($pages->offset)->limit(12)->all();

        }

        $more_posts = false;

        if(\count($posts) < 4) $more_posts = Profile::find()->limit(8)
            ->all();

        return $this->render('index', [

            'posts' => $posts,
            'city' => $city,
            'param' => $param,
            'pages' => $pages,
            'more_posts' => $more_posts,

        ]);
    }
}