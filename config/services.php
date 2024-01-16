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

    'envia' => [
        'base_uri' => env('ENVIA_BASE_URI'),
        'query_uri' => env('ENVIA_QUERY_URI'),
        'token' => env('ENVIA_TOKEN'),
        'class' => App\Services\EnviaService::class,
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'shipp1' => [
		'base_uri' => env('SHIPP1_BASE_URI'),
		'token' => env('SHIPP1_TOKEN'),
        'class' => App\Services\Shipp1Service::class,
	],

    'skydropx' => [
		'base_uri' => env('SKYDROPX_BASE_URI'),
		'token' => env('SKYDROPX_TOKEN'),
        'class' => App\Services\SkydropxService::class,
	],

];
