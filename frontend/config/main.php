<?php

use Imagine\Image\ManipulatorInterface;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => 'Знакомства для взрослых',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'chat' => [
            'class' => 'frontend\modules\chat\Chat',
        ],
        'user' => [
            'class' => 'frontend\modules\user\User',
        ],
        'wall' => [
            'class' => 'frontend\modules\wall\Wall',
        ],
        'advert' => [
            'class' => 'frontend\modules\advert\advert',
        ],
    ],
    'components' => [
        'formatter' => [
            'dateFormat' => 'd.MM.Y',
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'enableCsrfValidation' => false
        ],
        'imageCache' => [
            'class' => 'frontend\components\ImageCache',
            'sourcePath' => '@app/web/files/uploads',
            'sourceUrl' => '@web/files/uploads',
            'thumbsPath' => '@app/web/thumbs',
            'extensions' => [
 //               'jpg' => 'jpeg',
/*                'jpeg' => 'jpeg',
                'png' => 'png',
                'gif' => 'gif',
                'bmp' => 'bmp',*/
                'jpg' => 'webp',
                'webp' => 'webp',
            ],
            'sizes' => [
                'popular' => [126, 126],
                'popular_big' => [156, 156],
                'single-main' => [260, 320],
                'single-510' => [510, 627],
                'gallery-mini' => [123, 123],
                'listing' => [277, 266],
                'listing_500' => [470, 500],
                'large' => [600, 600],
                'dialog' => [50, 50],
                '80' => [80, 80],
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
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
                '<protocol>://<city:[a-z-0-9]+>.<domain>/pay' => 'cash/pay',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/robots.txt' => 'site/robot',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/auth' => 'site/auth',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/site/auth' => 'site/auth',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/photo-row/get-form' => 'photo-row/get-form',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/photo-row/add' => 'photo-row/add',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cust' => 'site/cust',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/feedback' => 'site/feed-back',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/novosti' => 'news/list',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/novosti/more' => 'news/more',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/polzovatelskoe-soglashenie' => 'site/agree',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user' => 'user/user/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/signup' => 'user/auth/signup',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/setting/profile' => 'user/edit/edit-profile',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/setting/anket' => 'user/edit/edit-anket',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/login' => 'user/auth/login',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/logout' => 'user/auth/logout',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/balance' => 'user/user/balance',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/photo/add' => 'user/photo/upload',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/photo' => 'user/photo/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/photo/delete' => 'user/photo/delete',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/friends/add' => 'user/friends/add',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/friends/request/remove' => 'user/friends/remove-request',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/friends/request/remove-send' => 'user/friends/remove-send-request',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/friends/remove' => 'user/friends/remove-friend',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/<id:[0-9]+>' => 'anket/view',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/friends/<id:[0-9]+>' => 'user/friends/list',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/friends/check' => 'user/friends/check',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/chat' => 'chat/chat/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/chat/<id:[0-9]>' => 'chat/chat/chat',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/chat/send' => 'chat/chat/send',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/chat/get' => 'chat/chat/get',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/adverts/<id:[0-9]+>' => 'advert/advert/view',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/ad' => 'advert/advert/ad',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/adverts' => 'advert/advert/list',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/more-adverds' => 'advert/advert/more',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/wall/add' => 'wall/wall/add',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/wall/comment' => 'wall/wall/comment',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/wall/item/like' => 'wall/wall/item-like',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/wall/item/delete' => 'wall/wall/item-delete',

                '<protocol>://<city:[a-z-0-9]+>.<domain>/site/verify-email' => 'user/auth/verify-email',

                '<protocol>://<city:[a-z-0-9]+>.<domain>/city/search' => 'city/search',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/present/get-form' => 'present/form',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/present/get-presents' => 'present/presents',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/present/gift' => 'present/gift',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/<param:[a-z-0-9]+>' => 'filter/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/<param:([a-z-0-9]+/)+[a-z-0-9]+>' => 'filter/index',

                'thumbs/<path:.*>' => 'site/thumb',

            ],
        ],
    ],
    'params' => $params,
];
