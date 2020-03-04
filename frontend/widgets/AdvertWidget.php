<?php


namespace frontend\widgets;

use frontend\modules\advert\models\Advert;
use yii\base\Widget;

class AdvertWidget extends Widget
{
    public function run()
    {
        $lastAdvert = Advert::find()->limit(12)->orderBy('id DESC')->with('userRelations')->all();

        return $this->render('advert', [
            'lastAdvert' => $lastAdvert,
        ]);
    }

    public function init()
    {

    }
}