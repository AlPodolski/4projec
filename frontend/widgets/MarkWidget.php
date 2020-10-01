<?php


namespace frontend\widgets;

use common\models\PageMark;
use Yii;
use yii\base\Widget;

class MarkWidget extends Widget
{

    public $url;

    public function run()
    {

        $marks = Yii::$app->cache->get(Yii::$app->params['mark_cache'].'_'.$this->url);

        if ($marks === false) {

            $marks = PageMark::find()
                ->where(['page_url' => $this->url])
                ->asArray()
                ->all();

            Yii::$app->cache->set(Yii::$app->params['mark_cache'].'_'.$this->url, $marks);

        }

        return $this->render('marks', [
            'marks' => $marks,
        ]);

    }
}