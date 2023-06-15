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
        '/reset-password' => 'site/reset-password',
        '/request-password-reset' => 'site/request-password-reset',
        '/signup' => 'site/signup',
        '/signup-confirm' => 'site/signup-confirm',
        '/login' => 'site/login',
        '/invitation-create' => 'invitation/create',
        '/invitations' => 'invitation/index',
        '/<view:[\w-]+>' => '/invitation/view',
        '/preview/<view:[\w-]+>' => '/invitation/preview',
        '/ru/<view:[\w-]+>' => '/<view:[\w-]+>',


        '/admin/field-values/<invitation_id:\d+>' => '/admin/field-values/index',
//        '/<view:[\w-]+>' => '/invitations/default/index',
//        '/preview/<view:\w+>' => '/invitations/default/preview',
//        '/ru/<view:[\w-]+>' => '/<view:[\w-]+>',
        '/manage/messages/<invitation_id:\d+>' => '/manage/messages/index',
        '/manage/invitations' => '/manage/invitations/index',
        //'/manage/' => '/manage/invitations/index',
    ],
];