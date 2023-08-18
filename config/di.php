<?php

use app\repositories\InvitationRepository;
use app\repositories\PaymentRepository;
use app\services\auth\RecoverService;
use app\services\auth\SignupService;
use app\services\invitations\InvitationService;
use app\services\Kassa24PaymentService;
use app\services\OrderService;

return [
    'definitions' => [
        InvitationService::class => InvitationService::class,
        SignupService::class => SignupService::class,
        RecoverService::class => RecoverService::class,
        OrderService::class => OrderService::class,
        Kassa24PaymentService::class => Kassa24PaymentService::class,
        PaymentRepository::class => PaymentRepository::class,
        InvitationRepository::class => InvitationRepository::class,
    ],
];
