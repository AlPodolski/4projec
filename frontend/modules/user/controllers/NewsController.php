<?php


namespace frontend\modules\user\controllers;

use frontend\modules\user\models\News;
use Yii;
use yii\web\Controller;

class NewsController extends Controller
{
    public function actionList($city)
    {

        if (!Yii::$app->user->isGuest){

            if (Yii::$app->request->isPost) {

                return  \frontend\modules\wall\widgets\WallWidget::widget([
                    'user_id' => Yii::$app->user->id,
                    'news' => true,
                    'wrapCssClass' => 'm-bottom-20',
                    'offset' => Yii::$app->params['wall_items_limit'] * Yii::$app->request->post('page'),

                ]);

            }

            return $this->render('list');

        }

        return $this->goHome();

    }
}