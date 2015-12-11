<?php

return [

    /*
    |--------------------------------------------------------------------------
    | デフォルトキュードライバー
    |--------------------------------------------------------------------------
    |
    | LaravelキューAPIは同じ文法を使用して様々なバックエンドが使用できるよう
    | 統一されたAPIをサポートしています。ここではデフォルトキュードライバーを
    | 設定します。
    |
    | サポートドライバー： "null", "sync", "database", "beanstalkd",
    |            "sqs", "iron", "redis"
    |
    */

    'default' => env('QUEUE_DRIVER', 'sync'),

    /*
    |--------------------------------------------------------------------------
    | キュー接続
    |--------------------------------------------------------------------------
    |
    | ここでアプリケーションが使用するそれぞれのサーバーに対する接続情報を
    | 設定します。それぞれのバックエンドのデフォルト接続はLaravelに最初から
    | 設定されています。自由に追加してください。
    |
    */

    'connections' => [

        'sync' => [
            'driver' => 'sync',
        ],

        'database' => [
            'driver' => 'database',
            'table'  => 'jobs',
            'queue'  => 'default',
            'expire' => 60,
        ],

        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host'   => 'localhost',
            'queue'  => 'default',
            'ttr'    => 60,
        ],

        'sqs' => [
            'driver' => 'sqs',
            'key'    => 'your-public-key',
            'secret' => 'your-secret-key',
            'queue'  => 'your-queue-url',
            'region' => 'us-east-1',
        ],

        'iron' => [
            'driver'  => 'iron',
            'host'    => 'mq-aws-us-east-1.iron.io',
            'token'   => 'your-token',
            'project' => 'your-project-id',
            'queue'   => 'your-queue-name',
            'encrypt' => true,
        ],

        'redis' => [
            'driver'     => 'redis',
            'connection' => 'default',
            'queue'      => 'default',
            'expire'     => 60,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | 失敗したキュージョブ
    |--------------------------------------------------------------------------
    |
    | このオプションでは失敗したキュージョブをログする振る舞いを設定します。
    | どのデータベースとテーブルを保存に使用するかをコントロールできます。
    | お好きなデータベース／テーブルに変更して下さい。
    |
    */

    'failed' => [
        'database' => 'mysql', 'table' => 'failed_jobs',
    ],

];
