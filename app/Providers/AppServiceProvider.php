<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * アプリケーションの初期処理のためのサービスプロバイダ
 *
 * 自由に使用できるように、あらかじめ用意されている空のプロバイダ。
 *
 * サービスプロバイダ :
 *   本文 : 「5-2 サービスプロバイダ」(P.264)
 *   ドキュメント : http://readouble.com/laravel/5/1/ja/providers.html
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * アプリケーションサービスの初期化処理
     */
    public function boot()
    {
        //
    }

    /**
     * アプリケーションサービスの登録
     */
    public function register()
    {
        //
    }
}
