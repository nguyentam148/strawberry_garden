<?php

return [
    'admin_emails' => env('MAIL_ADMIN', ''),
    'asset_version' => '20210728_0935',
    'auth_guard' => [
        'admin' => 'administrators',
        'website' => 'students'
    ]
];
