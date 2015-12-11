<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

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
     * @param \Illuminate\Routing\Router $router
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
