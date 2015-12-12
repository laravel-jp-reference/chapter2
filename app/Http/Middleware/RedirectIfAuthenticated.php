<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

/**
 * 未認証（未ログイン）ユーザーのみ通過させるミドルウェア
 */
class RedirectIfAuthenticated
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
        // checkメソッドはログイン時にtrueとなる
        if ($this->auth->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
