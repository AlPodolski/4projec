<?php


namespace frontend\assets;
use yii\web\AssetBundle;

class SlickAsset extends AssetBundle
{
    public $sourcePath = '@bower/slick-carousel';
    public $css = [
        'slick/slick-theme.css',
        'slick/slick.css',
    ];

    public $js = [
        'slick/slick.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}