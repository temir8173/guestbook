<?php

use codemix\localeurls\UrlManager;

return [
    'class' => UrlManager::class,
    'languages' => ['kk', 'ru'],
    'enableDefaultLanguageUrlCode' => false,
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '/' => 'site/index',
        '/templates' => 'site/templates',
        '/rules' => 'site/rules',
        '/privacy' => 'site/privacy-policy',
        '/online-payment' => 'site/online-payment',
        '/warranty' => 'site/warranty',
        '/contract-offer' => 'site/contract-offer',

        // auth routes
        '/reset-password' => 'auth/reset-password',
        '/request-password-reset' => 'auth/request-password-reset',
        '/signup' => 'auth/signup',
        '/signup-confirm' => 'auth/signup-confirm',
        '/login' => 'auth/login',
        '/site/login' => 'auth/login',
        '/logout' => 'auth/logout',

        // payment
        '/payment/<orderId:\d+>' => 'payment/pay',

        // invitations
        '/create-invitation' => 'invitation/create',
        '/edit-invitation/<url:[\w-]+>' => 'invitation/update',
        '/invitations' => 'invitation/index',
        '/<url:[\w-]+>' => '/invitation/view',
        '/ru/<url:[\w-]+>' => '/<url:[\w-]+>',


        '/admin/field-values/<invitation_id:\d+>' => '/admin/field-values/index',
    ],
];