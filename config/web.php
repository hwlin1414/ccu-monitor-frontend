<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'zh-TW',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'erR6h8plqclIFhrrvwYfSqLMgw7vGFBY',
        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
            'redis' => [
                'hostname' => 'localhost',
                'port' => 6379,
                'database' => 0,
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            //'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'app\logs\AppTarget',
                    'logTable' => 'Logs',
                    'categories' => ['app\*'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'global-config' => 'global-config/index',
                'global-config/create' => 'global-config/create',
                'global-config/<id:[-.a-zA-Z0-9]+>' => 'global-config/update',
                'global-config/<id:[-.a-zA-Z0-9]+>/delete' => 'global-config/delete',
                'groups' => 'groups/index',
                'groups/<id:\d+>' => 'groups/view',
                'groups/<id:\d+>/update' => 'groups/update',
                'groups/<id:\d+>/delete' => 'groups/delete',
                'groups/<group_id:\d+>/delete-perms' => 'groups/delete-perms',
                'users/' => 'users/index',
                'users/create' => 'users/create',
                'users/<name:[a-zA-Z0-9._]+>/view' => 'users/view',
                'users/<name:[a-zA-Z0-9._]+>/update' => 'users/update',
                'users/<name:[a-zA-Z0-9._]+>/delete' => 'users/delete',
                'self' => 'users/self',
                'logs' => 'logs/index',
            ],
        ],
        'formatter' => [
            'booleanFormat' => [
                '<i class="material-icons">clear</i>',
                '<i class="material-icons">done</i>',
            ],
        ],
        'session' => [
            'class' => 'yii\web\CacheSession',
            // 'cache' => 'mycache',
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        #'allowedIPs' => ['140.123.*.*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
