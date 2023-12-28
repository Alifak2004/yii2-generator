<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    // added new 2023 by ali
    'modules' => [
        'gridview' => [
            'class' => 'kartik\grid\Module',
            'bsVersion' => '5.x',
            // other module settings, if any
        ],
        'gridviewKrajee' => [
            'class' => 'kartik\grid\Module',
            'bsVersion' => '5.x',
            // other module settings, if any
        ],
    ],

    'components' => [
        // ADDED NEW BY ALI-------------------
        'contextMenu' => [
            'class' => 'kartik\contextmenu\ContextMenu',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app_ar' => 'app.php', // Arabic translation file
                    ],
                ],
            ],
        ],
        // deny all users that are guest (not logged in)
        
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'class' => 'yii\bootstrap5\BootstrapAsset',
                ],
                'kartik\form\ActiveFormAsset' => [
                    'bsDependencyEnabled' => false // disable bootstrap CSS dependency
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null, // Set sourcePath to null to prevent duplicate asset loading
                ],
            ],
        ],
        // TILL HERE--------------------
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Iam_The_validation_Key',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],
        // ADDED HERE
        'on beforeRequest' => function ($event) {
            Yii::$app->language = Yii::$app->session->get("code");
        },
        // 0-----------------

    ],
    'params' => $params,
];


if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20', '172.16.0.0/12'],
        'generators' => [ //here
            'crud' => [ // generator name
                'class' => 'yii\gii\generators\CRUD_DATABLE\Generator', // generator class
                'templates' => [ //setting for out templates
                    'myCrud' => '@app/my_templates/crud/default', // template name => path to template
                ]
            ]
        ],
    ];
}

return $config;
