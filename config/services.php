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

    
    'google' => [
        'client_id' => '514459465592-gaqjohvhef6r5di8icom0ah0be0hb25l.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://dev.agileprolific.com/auth/google/callback',
    ],

    'facebook' => [

        'client_id' => '231040379846233',
        'client_secret' => 'ccdce0739c45ae1cf0324e43c481725b',
        'redirect' => 'https://dev.agileprolific.com/auth/facebook/callback',

    ],

];
