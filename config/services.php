<?php

return [

    'meals' => [
        'base_uri' => env('MEALS_SERVICE_BASE_URI')
    ],
    
    'dishes' => [
        'base_uri' => env('DISHES_SERVICE_BASE_URI')
    ],

    'restaurants' => [
        'base_uri' => env('RESTAURANTS_SERVICE_BASE_URI')
    ],

    'reservations' => [
        'base_uri' => env('RESERVATIONS_SERVICE_BASE_URI')
    ],
    
    'household' => [
        'base_uri' => env('HOUSEHOLD_SERVICE_BASE_URI')
    ],
    
    'lists' => [
        'base_uri' => env('LISTS_SERVICE_BASE_URI')
    ],
    
    'ingredients' => [
        'base_uri' => env('INGREDIENTS_SERVICE_BASE_URI')
    ],
    
    'maps' => [
        'apikey' => env('MAPS_API_KEY')
    ],
    
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

];
