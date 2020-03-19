<?php


namespace frontend\assets;
use yii\web\AssetBundle;

class LightGalleryAsset extends AssetBundle
{
    public $sourcePath = '@bower/lightgallery';
    public $css = [
        'dist/css/lightgallery.css',
    ];

    public $js = [
        'dist/js/lightgallery-all.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}