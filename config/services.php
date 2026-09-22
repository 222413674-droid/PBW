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

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // BPS Sulawesi Selatan / dashboard integrations.
'BPS' => [
    'domain' => env('BPS_DOMAIN', '7300'),
    'api_key' => env('BPS_API_KEY', ''),
    'app_id' => env('BPS_APP_ID', ''),
    'infographic_domain' => env('BPS_INFOGRAPHIC_DOMAIN', '7371'),
    'indicators' => [
        'BPS_POPULATION_VAR' => env('BPS_POPULATION_VAR', ''),
        'BPS_ECONOMIC_GROWTH_VAR' => env('BPS_ECONOMIC_GROWTH_VAR', ''),
        'BPS_UNEMPLOYMENT_VAR' => env('BPS_UNEMPLOYMENT_VAR', ''),
        'BPS_POVERTY_VAR' => env('BPS_POVERTY_VAR', ''),
    ],
],
'weather' => [
    'latitude' => env('WEATHER_LATITUDE', '-5.1477'),
    'longitude' => env('WEATHER_LONGITUDE', '119.4327'),
    'location' => env('WEATHER_LOCATION', 'Makassar'),
],
];
