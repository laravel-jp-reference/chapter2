<?php

return [

    /*
    |--------------------------------------------------------------------------
    | サードパーティーサービス
    |--------------------------------------------------------------------------
    |
    | このファイルは、Stripe、Mailgun、Mandrillなどのサードパーティーサービスの
    | 証情報を保存しておくためのものです。
    | 様々な認証情報をパッケージから簡単に見つけられるように、この主のタイプの
    | 情報をまとめておくデフォルトの場所を用意するのは、筋が通っているでしょう。
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

];
