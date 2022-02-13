<?php

use app\components\AuthManager;
use app\models\UserIdentity;
use himiklab\yii2\recaptcha\ReCaptchaConfig;
use mihaildev\elfinder\PathController;
use yii\helpers\ArrayHelper;
use yii\swiftmailer\Mailer;

$params = ArrayHelper::merge(
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
$db = ArrayHelper::merge(
    require __DIR__ . '/db.php',
    require __DIR__ . '/db-local.php'
);
$urlManager = require __DIR__ . '/_url-manager.php';
$i18n = require __DIR__ . '/_i18n.php';

$config = [
    'id' => 'basic',
    'name' => 'Шақыру KZ',
    'language' => 'kk',
    'sourceLanguage' => 'kk',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '1DeIREvi_vTIqsUQGACSWlJDuCryfVXC',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => UserIdentity::class,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => Mailer::class,
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => true,
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'your-host',
                'username' => 'username',
                'password' => 'pwd',
                'port' => '465',
                'encryption' => 'ssl',
            ],
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
        
        'urlManager' => $urlManager,
        'i18n' => $i18n,
        'authManager' => [
            'class' => AuthManager::class,
        ],
        'formatter' => [
            'dateFormat' => 'dd.MM.yyyy',
            'datetimeFormat' => 'dd.MM.yyyy h:i:s',
            'decimalSeparator' => '.',
            'thousandSeparator' => ' ',
            'currencyCode' => 'KZT',
       ],
        'reCaptcha' => [
            'class' => ReCaptchaConfig::class,
            'siteKeyV2' => 'some-siteKey',
            'secretV2' => 'some-siteKey',
            'siteKeyV3' => 'your siteKey v3',
            'secretV3' => 'your secret key v3',
        ],
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => '@app/views/layouts/admin',
        ],
        'invitations' => [
            'class' => 'app\modules\invitations\Module',
            'layout' => '@app/views/layouts/invitation'
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
        'manage' => [
            'class' => 'app\modules\manage\Module',
            'layout' => '@app/modules/manage/views/layouts/manage',
        ],
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => PathController::class,
            'access' => ['?'],
            'root' => [
                'path' => 'upload/global',
                'name' => 'Global'
            ],
        ]
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
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return ArrayHelper::merge(
    $config,
    require __DIR__ . '/web-local.php'
);
