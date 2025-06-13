<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => [
        'api/*',
        'sanctum/csrf-cookie',
        'login',
        'logout',
        'getUser',
        'register',
        'customers',
        'customersUser/*',
        'customers/*',
        'customer/*',
        'profile',
        'contracts',
        '*/contracts',
        'employees',
        'appointments',
        'appointments/*',
        'services',
        'specialties',
        'verify-email/*',
        'password/*',
        'citas',
        '*/customers',
        'employees/change/*',
        'appointments/cancel/{id}',
        'appointments/complete/{id}'
    ],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:4200', 'http://localhost:8001'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
