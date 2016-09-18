<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'iwbNwI-S4WgKu9nUGAqWctOkptizsNKk',
        ],
        'util' => [
            'class' => 'app\components\Util',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
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
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'class' => 'app\components\SintretUrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'logout' => 'site/logout',
                'login' => 'site/login',
                '' => 'site/index',
                'change-password'=>'site/change_password',
                'forgot-password'=>'site/forgot_password'
            //'debug/<controller>/<action>' => 'debug/<controller>/<action>',
            ]
        ],
    ],
    'params' => $params,
    'modules' => [
        'dynagrid' => [
            'class' => '\kartik\dynagrid\Module',
            'defaultPageSize' => 100,
            'minPageSize' => 50,
            'maxPageSize' => 500,
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ]
    ],
];


if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'crud' => [
                'class' => 'sintret\diesel\generators\crud\Generator',
            ],
            'model' => [
                'class' => 'sintret\diesel\generators\model\Generator'
            ]
        ]
    ];
}

return $config;
