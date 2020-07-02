<?php


namespace console\controllers;

use frontend\modules\user\models\Popular;
use yii\console\Controller;
use frontend\modules\user\models\Profile;

class PopularController extends Controller
{
    public function actionAdd()
    {
        $post_id = Profile::find()->where(['fake' => 0])->asArray()->orderBy(['rand()' => SORT_DESC])->select('id')->one();

        $popular = new Popular();
        $popular->user_id = $post_id['id'];
        $popular->created_at = \time();

        $popular->save();

    }
}