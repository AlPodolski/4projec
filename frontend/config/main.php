<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'user' => [
            'class' => 'frontend\modules\user\User',
        ],
        'advert' => [
            'class' => 'frontend\modules\advert\advert',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'enableCsrfValidation' => false
        ],
        'imageCache' => [
            'class' => 'iutbay\yii2imagecache\ImageCache',
            'sourcePath' => '@app/web/files/uploads',
            'sourceUrl' => '@web/files/uploads',
            'thumbsPath' => '@app/web/thumbs',
            'sizes' => [
                'popular' => [180, 200],
                'medium' => [300, 300],
                'large' => [600, 600],
            ],
        ],
        'user' => [
            'identityClass' => 'frontend\modules\user\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<protocol>://<city:[a-z-0-9]+>.<domain>/' => 'site/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user' => 'user/user/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/signup' => 'user/auth/signup',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/setting/profile' => 'user/edit/edit-profile',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/setting/anket' => 'user/edit/edit-anket',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/login' => 'user/auth/login',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/logout' => 'user/auth/logout',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/photo/add' => 'user/photo/upload',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/<id:[0-9]+>' => 'anket/view',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/ad' => 'advert/advert/ad',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/adverts' => 'advert/advert/list',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/more-adverds' => 'advert/advert/more',

                'thumbs/<path:.*>' => 'site/thumb',

            ],
        ],
    ],
    'params' => $params,
];
