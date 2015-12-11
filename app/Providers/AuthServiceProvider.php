<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
