<?php


namespace frontend\widgets;

use common\models\PageMark;
use yii\base\Widget;

class MarkWidget extends Widget
{

    public $url;

    public function run()
    {

        $marks = PageMark::find()->where(['page_url' => $this->url])->asArray()->all();

        return $this->render('marks', [
            'marks' => $marks,
        ]);

    }
}