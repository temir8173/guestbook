<?php

use app\components\AuthManager;
use app\models\UserIdentity;
use himiklab\yii2\recaptcha\ReCaptchaConfig;
use mihaildev\elfinder\PathController;
use yii\swiftmailer\Mailer;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$urlManager = require __DIR__ . '/_url-manager.php';
$i18n = require __DIR__ . '/_i18n.php';
$di = require __DIR__ . '/di.php';

$config = [
    'id' => 'basic',
    'timeZone' => 'Asia/Almaty',
    'name' => 'Шақыру KZ',
    'language' => 'kk',
    'sourceLanguage' => 'kk',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'app\components\DisableLanguageMiddleware'
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '1DeIREvi_vTIqsUQGACSWlJDuCryfVXC',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
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
            'useFileTransport' => $_ENV['USEFILETRANSPORT'],
            'transport' => [
                'class' => "Swift_SmtpTransport",
                'host' => $_ENV['SMTPHOST'],
                'username' => $_ENV['SMTPUSERNAME'],
                'password' => $_ENV['SMTPPASSWORD'],
                'port' => $_ENV['SMTPPORT'],
                'encryption' => $_ENV['SMTPENCRYPTION'],
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
            'timeZone' => 'Asia/Almaty',
            'decimalSeparator' => '.',
            'thousandSeparator' => ' ',
            'currencyCode' => 'KZT',
       ],
        'reCaptcha' => [
            'class' => ReCaptchaConfig::class,
            'siteKeyV2' => $_ENV['RECAPTCHA_SITEKEY_V2'],
            'secretV2' => $_ENV['RECAPTCHA_SECRET_V2'],
//            'siteKeyV3' => $_ENV['RECAPTCHA_SITEKEY_V3'],
//            'secretV3' => $_ENV['RECAPTCHA_SECRET_V3'],
        ],
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => '@app/views/layouts/admin',
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
    'container' => $di,
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

return $config;
