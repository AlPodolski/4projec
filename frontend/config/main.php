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
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'enableCsrfValidation' => false
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
            ],
        ],
    ],
    'params' => $params,
];
