<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '721782202550351',
        'client_secret' => '89f946d0c7fca93a807cb1a3df23c17b',
        'redirect' => 'https://360pic.com/callback',
    ],

    'google' => [
        'client_id' => '139875157057-irlpd9vb2hku7h4c09k16u641sda8u1s.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://360pic.com/auth/google/callback',
    ],

];
