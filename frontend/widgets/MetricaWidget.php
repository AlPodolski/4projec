<?php


namespace frontend\widgets;

use yii\base\Widget;

class MetricaWidget extends Widget
{
    public function init()
    {

    }

    public function run()
    {
        return $this->render('metrica');
    }
}