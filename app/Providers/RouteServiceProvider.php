<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

/**
 * ルート定義のためのサービスプロバイダ
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * この名前空間はルートファイルのコントローラールートへ適用されます。
     *
     * さらに、URLジェネレーターのルート名前空間としても設定されます。
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * ルートモデル結合、パターンフィルターなどを定義
     *
     * 参照 :
     *   http://readouble.com/laravel/5/1/ja/routing.html#parameters-regular-expression-constraints
     *   http://readouble.com/laravel/5/1/ja/routing.html#route-model-binding
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
    }

    /**
     * アプリケーションのルートを定義
     *
     * 参照 : http://readouble.com/laravel/5/1/ja/routing.html#route-group-namespaces
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
