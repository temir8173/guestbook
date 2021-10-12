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
        '/reset-password' => 'site/reset-password',
        '/request-password-reset' => 'site/request-password-reset',
        '/signup' => 'site/signup',
        '/login' => 'site/login',
        '/admin/field-values/<invitation_id:\d+>' => '/admin/field-values/index',
        '/<view:[\w-]+>' => '/invitations/default/index',
        '/preview/<view:\w+>' => '/invitations/default/preview',
        '/ru/<view:[\w-]+>' => '/<view:[\w-]+>',
        '/manage/messages/<invitation_id:\d+>' => '/manage/messages/index',
        '/manage/invitations' => '/manage/invitations/index',
        //'/manage/' => '/manage/invitations/index',
    ],
];