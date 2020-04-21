<?php


namespace frontend\widgets;

use frontend\models\forms\FeedBackForm;
use yii\base\Widget;

class FeedBackFormWidget extends Widget
{
    public function init()
    {

    }

    public function run()
    {
        $model = new FeedBackForm();

        return $this->render('feedback-form', [
            'model' => $model,
        ]);
    }
}