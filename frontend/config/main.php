<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => 'Знакомства 4dosug',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'chat' => [
            'class' => 'frontend\modules\chat\Chat',
        ],
        'events' => [
            'class' => 'frontend\modules\events\events',
        ],
        'user' => [
            'class' => 'frontend\modules\user\User',
        ],
        'wall' => [
            'class' => 'frontend\modules\wall\Wall',
        ],
        'sympathy' => [
            'class' => 'frontend\modules\sympathy\Sympathy',
        ],
        'advert' => [
            'class' => 'frontend\modules\advert\advert',
        ],
        'group' => [
            'class' => 'frontend\modules\group\group',
        ],
    ],
    'components' => [
        'assetManager' =>[
            'bundles' => [
                'yii\authclient\widgets\AuthChoiceStyleAsset' => false,
            ],
        ],
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
                'jpeg' => 'jpeg',
                'png' => 'png',
                'gif' => 'gif',
                'bmp' => 'bmp',
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
                '400_500' => [400, 500],
            ],
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
                'thumbs/<path:.*>' => 'site/thumb',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/' => 'site/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/site/cust' => 'site/cust',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/news' => 'user/news/list',
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
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/events' => 'events/events/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/sympathy' => 'sympathy/sympathy/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/sympathy/get-settings' => 'sympathy/sympathy/get-settings',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/sympathy/set-settings' => 'sympathy/sympathy/set-settings',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/sympathy/add' => 'sympathy/sympathy/add',
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
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/group' => 'group/group/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/group/<id:[0-9]+>' => 'group/group/group',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/group/<id:[0-9]+>' => 'group/group/user-group',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/group/subscribe' => 'group/group/subscribe',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/group/list' => 'group/group/list',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/group/item/add' => 'group/group/add',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/group/<id:[0-9]+>/subscribers' => 'group/group/subscribers',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/chat' => 'chat/chat/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/chat/<id:[0-9]+>' => 'chat/chat/chat',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/heart/get-form' => 'user/heart/get-form',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/heart/buy' => 'user/heart/buy',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/invitation/close' => 'invitation/close',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/chat/send/send-photo' => 'chat/chat/send-photo',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/chat/send' => 'chat/chat/send',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/chat/get' => 'chat/chat/get',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/adverts/<id:[0-9]+>' => 'advert/advert/view',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/ad' => 'advert/advert/ad',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/adverts' => 'advert/advert/list',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/more-adverds' => 'advert/advert/more',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/wall/add' => 'wall/wall/add',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/comment' => 'comment/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/ws' => 'socket/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/wall/item/like' => 'wall/wall/item-like',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/wall/item/delete' => 'wall/wall/item-delete',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/vip/buy' => 'vip/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/vip/gift' => 'vip/gift',

                '<protocol>://<city:[a-z-0-9]+>.<domain>/site/verify-email' => 'user/auth/verify-email',

                '<protocol>://<city:[a-z-0-9]+>.<domain>/city/search' => 'city/search',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/present/get-user-presents' => 'present/user-presents',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/present/get-form' => 'present/form',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/present/get-presents' => 'present/presents',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/present/gift' => 'present/gift',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/get-feed-back-form' => 'site/get-feed-back-form',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/<param:[a-z-0-9]+>' => 'filter/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/<param:([a-z-0-9]+/)+[a-z-0-9]+>' => 'filter/index',


            ],
        ],
    ],
    'params' => $params,
];
