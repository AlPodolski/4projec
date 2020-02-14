<?php


namespace frontend\controllers;

use common\models\News;
use yii\web\Controller;
use Yii;

class NewsController extends Controller
{
    public function actionList($city){

        $newsList = News::find()->limit(Yii::$app->params['advert_limit'])->orderBy('id DESC')->all();

        return $this->render('list', [
            'newsList' => $newsList
        ]);
    }

    public function actionMore()
    {
        if (Yii::$app->request->isPost){

            $newsList = News::find()->limit(Yii::$app->params['advert_limit'])->offset(Yii::$app->params['advert_limit'] * Yii::$app->request->post('page'))->orderBy('id DESC')->all();

            if ($newsList) return $this->renderFile('@app/views/news/more.php', [
                'newsList' => $newsList
            ]);

        }

        exit();
    }
}