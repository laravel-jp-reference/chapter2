<?php

namespace App\Providers;

use App\Events\UserRegistered;
use App\Listeners\MailConfirmer;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * イベントと対応するリスナー登録のためのサービスプロバイダ
 *
 * 参照 :
 *   本文 : 「4-5 イベント」(P.190)
 *   ドキュメント : http://readouble.com/laravel/5/1/ja/events.html
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * アプリケーションのイベントリスナーのマップ
     *
     * @var array
     */
    protected $listen = [
        // ユーザー登録イベントとメール確認ハンドラーのマップ
        UserRegistered::class => [
            MailConfirmer::class,
        ],
    ];

    /**
     * アプリケーションのその他のイベントの登録
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
