<?php

namespace App\Providers;

use App\Events\UserRegistered;
use App\Listeners\MailConfirmer;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
