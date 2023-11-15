<?php

return [
    'adminEmail' => 'admin@shaqiru.kz',
    'senderEmail' => $_ENV['SMTPUSERNAME'],
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,

    'kassa24Login' => $_ENV['KASSA24_LOGIN'],
    'kassa24Password' => $_ENV['KASSA24_PASSWORD'],
    'kassa24DemoPayment' => $_ENV['KASSA24_DEMO_PAYMENT'],

    'googleClientId' => $_ENV['GOOGLECLIENTID'],
    'googleClientSecret' => $_ENV['GOOGLECLIENTSECRET'],
    'googleRedirectUri' => $_ENV['GOOGLEREDIRECTURI'],

    'smscLogin' => $_ENV['SMSC_LOGIN'],
    'smscPassword' => $_ENV['SMSC_PASSWORD'],
];
