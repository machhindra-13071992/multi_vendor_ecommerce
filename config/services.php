<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
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

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
   //Local 
    'google' => [
        'client_id' => '715695408059-knvvq2rum2lq3aoq2fumms92qjrkgr09.apps.googleusercontent.com',
        'client_secret' => 'wUcrvkd5OWLoUkD8d9gkUpy-',
        //'redirect' => 'http://learnl52.hd/auth/google/callback',
        'redirect' => 'http://localhost:80/athena/auth/google/callback',
    ],
    //Staging
    /*'google' => [
        'client_id' => '715695408059-m99ok1jcev8f8obh7t12poucpu8rfc5e.apps.googleusercontent.com',
        'client_secret' => 'RoZ-wybco9yIZk6-2o69RmLN',
        'redirect' => 'https://stagingathena.azurewebsites.net/auth/google/callback',
    ],*/
    //Live
    /*'google' => [
        'client_id' => '715695408059-efs0qeemmgvt8vdg75ve3knvgli9b4vk.apps.googleusercontent.com',
        'client_secret' => 'xyE2DTvm5IEV7wuFD_kxAulf',
        'redirect' => 'https://athena.thenewj.com/auth/google/callback',
    ],*/
];
