<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins', // Use 'admins' for the admin provider
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_ADMIN_MODEL', App\Models\User::class), // Ensure this points to your Admin model
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        'admins' => [  // Separate password reset settings for admins
            'provider' => 'admins',
            'table' => 'password_reset_tokens', // You can customize this if needed
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
