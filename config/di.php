<?php

use app\services\auth\RecoverService;
use app\services\auth\SignupService;
use app\services\invitations\InvitationService;

return [
    'definitions' => [
        InvitationService::class => InvitationService::class,
        SignupService::class => SignupService::class,
        RecoverService::class => RecoverService::class,
    ],
];
