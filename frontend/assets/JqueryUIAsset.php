<?php


namespace frontend\assets;

use yii\web\AssetBundle;

class JqueryUIAsset  extends AssetBundle
{
    public $sourcePath = '@bower/jquery-ui';

    public $js = [
        'jquery-ui.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}