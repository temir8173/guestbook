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

        // auth routes
        '/reset-password' => 'auth/reset-password',
        '/request-password-reset' => 'auth/request-password-reset',
        '/signup' => 'auth/signup',
        '/signup-confirm' => 'auth/signup-confirm',
        '/login' => 'auth/login',
        '/logout' => 'auth/logout',

        // invitations
        '/create-invitation' => 'invitation/create',
        '/edit-invitation/<url:[\w-]+>' => 'invitation/update',
        '/invitations' => 'invitation/index',
        '/<url:[\w-]+>' => '/invitation/view',
        '/ru/<url:[\w-]+>' => '/<url:[\w-]+>',


        '/admin/field-values/<invitation_id:\d+>' => '/admin/field-values/index',
//        '/<view:[\w-]+>' => '/invitations/default/index',
//        '/preview/<view:\w+>' => '/invitations/default/preview',
//        '/ru/<view:[\w-]+>' => '/<view:[\w-]+>',
        '/manage/messages/<invitation_id:\d+>' => '/manage/messages/index',
        '/manage/invitations' => '/manage/invitations/index',
        //'/manage/' => '/manage/invitations/index',
    ],
];