<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OAuth Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for oauth genetics services such
    | as 23AndMe
    |
    */

    '23andme' => [
        'driver' => App\Domains\Genetic\Service\ThirdParty\Service23AndMe::class,
        'scope' => ['basic', 'names', 'email', 'genomes', 'report:all', 'phenotypes:read:all'],
        'base_uri' => env('23ANDME_BASE_URI'),

        'client_id' => env('23ANDME_CLIENT_ID'),
        'client_secret' => env('23ANDME_CLIENT_SECRET'),
        'redirect_uri' => env('23ANDME_REDIRECT_URI'),

        'timeout' => env('23ANDME_HTTP_TIMEOUT', 10),
        'header_authorization' => env('23ANDME_HTTP_HEADER_AUTHORIZATION', 'Authorization'),
    ],

    'helix' => [
        'driver' => App\Domains\Genetic\Service\ThirdParty\ServiceHelix::class,
        'token_uri' => env('HELIX_TOKEN_URI', 'https://api.staging.helix.com/v0/oauth/access_token'),
        'partner' => [
            'href' => env('HELIX_PARTNER_HREF', 'https://store.staging.helix.com/account/link'),
            'redirect_uri' => env('HELIX_PARTNER_REDIRECT_URI'),
            'sku' => env('HELIX_PARTNER_SKU'),
            'client_id' => env('HELIX_PARTNER_CLIENT_ID'),
            'client_secret' => env('HELIX_PARTNER_CLIENT_SECRET'),
            'app_id' => env('HELIX_PARTNER_APP_ID'),
            'scope' => 'partner_customer_delegation',
        ],
        'identity' => [
            'base_uri' => env('HELIX_IDENTITY_BASE_URI', 'https://api.staging.helix.com'),
            'client_id' => env('HELIX_IDENTITY_CLIENT_ID'),
            'client_secret' => env('HELIX_IDENTITY_CLIENT_SECRET'),
            'scope' => 'identity',
        ],
        'genomic' => [
            'base_uri' => env('HELIX_GENOMIC_BASE_URI', 'https://genomics.staging.helix.com'),
            'client_id' => env('HELIX_GENOMIC_CLIENT_ID'),
            'client_secret' => env('HELIX_GENOMIC_CLIENT_SECRET'),
            'scope' => 'genomics',
        ],
        'timeout' => env('HELIX_HTTP_TIMEOUT', 1000),
        'header_authorization' => env('HELIX_HTTP_HEADER_AUTHORIZATION', 'Authorization'),
    ],
];
