<?php

return [
    'default' => env('MAIL_MAILER', 'smtp'),

    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'sandbox.smtp.mailtrap.io'),
            'port' => env('MAIL_PORT', 2525),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'auth_mode' => 'login', // ou 'plain'
        ],
    ],    

    'from' => [
        'address' => 'play.on.series@gmail.com',
        'name' => 'Seu Nome',
    ],
    
    'reply_to' => [
        'address' => 'play.on.series@gmail.com',
        'name' => 'Seu Nome',
    ],
    
    'markdown' => [
        'theme' => 'default',
    
        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ]
];