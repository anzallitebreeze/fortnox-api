<?php

declare(strict_types=1);

return [
    'client_id' => env('FORTNOX_CLIENT_ID'),
    'client_secret' => env('FORTNOX_CLIENT_SECRET'),
    'redirect' => env('FORTNOX_REDIRECT'),
    'auth_endpoint' => 'https://apps.fortnox.se/oauth-v1/auth',
    'token_endpoint' => 'https://apps.fortnox.se/oauth-v1/token',
    'scopes' => [
        'bookkeeping',
        'archive',
        'connectfile',
        'article',
        'salary',
        'companyinformation',
        'settings',
        'invoice',
        'costcenter',
        'currency',
        'customer',
        'inbox',
        'payment',
        'noxfinansinvoice',
        'offer',
        'order',
        'price',
        'print',
        'project',
        'profile',
        'supplierinvoice',
        'supplier',
        'timereporting',
    ],
];
