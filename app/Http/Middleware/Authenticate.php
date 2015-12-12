<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

/**
 * デフォルトの認証ミドルウェア
 *
 * app/Http/Kernel.phpのrouteMiddlewareプロパティーで、
 * 'auth'ミドルウェアとして定義されている。
 */
class Authenticate
{
    /**
     * Guardの実装
     *
     * @var Guard
     */
    protected $auth;

    /**
     * 新しいフィルターインスタンス
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * 送られてきたリクエストの処理
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // guestメソッドは認証されていない場合にtrueになる
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                // AJAXリクエストの場合は、401レスポンスを返す
                return response('Unauthorized.', 401);
            } else {
                // AJAXではない通常のアクセスでは、リダイレクトの
                // guestメソッドで引数で指定したURIにリダイレクトさせる。
                // ログイン後、認証が必要となったURIへ自動的にリダイレクトされる。
                return redirect()->guest('auth/login');
            }
        }

        return $next($request);
    }
}
