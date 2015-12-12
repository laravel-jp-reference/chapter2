<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * 認証と認可のためのサービスプロバイダ
 *
 * 認証としてはカスタムドライバー使用時の拡張に使用する程度。
 *
 * 参照 : http://readouble.com/laravel/5/1/ja/authentication.html#adding-custom-authentication-drivers
 *
 * ほぼ、5.1.11で追加された認可機能の登録で使用する
 *
 * 参照 : http://readouble.com/laravel/5/1/ja/authorization.html
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * アプリケーションのためにマップ付けるポリシー
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * アプリケーションの認証と認可サービスの登録
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        //
    }
}
