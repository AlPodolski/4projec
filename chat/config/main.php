<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-chat',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'chat\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'chat' => [
            'class' => 'chat\modules\chat\Chat',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-chat',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-chat', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-chat',
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
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/chat/<id:[0-9]+>' => 'chat/chat/chat',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/chat/send' => 'chat/chat/send',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/chat/get' => 'chat/chat/get',

                '<protocol>://<city:[a-z-0-9]+>.<domain>/present/get-form' => 'present/form',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/present/get-presents' => 'present/presents',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/present/gift' => 'present/gift',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/chat/send/send-photo' => 'chat/chat/send-photo',
            ],
        ],
    ],
    'params' => $params,
];
