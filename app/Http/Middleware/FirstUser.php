<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

/**
 * ユーザーIDが1の認証済みユーザーのみ通過させるカスタムミドルウェア
 *
 * 'auth.first'ミドルウェアの定義 : app/Http/Kernel.php $routeMiddlewareプロパティ
 */
class FirstUser
{
    /**
     * ミドルウェアの本体。デフォルトでhandleメソッドが呼び出される。
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 未認証であればログインさせる。
        // guestメソッドは指定したURL(/auth/login)へリダイレクトさせ、
        // 認証後に最初にアクセスしたURLへ自動的にリダイレクトさせる。
        if (Auth::guest()) {
            return redirect()->guest('auth/login');
        }

        // ユーザーIDのチェック
        if (Auth::user()->id != 1) {
            // abortヘルパーは指定されたステータスコードの
            // Symfony\Component\HttpKernel\Exception\HttpException
            // 例外を発生させる。
            // このHttpException例外はIlluminate\Foundation\Exceptions\Handler
            // クラスにより、'error.ステータスコード'のビューが存在すれば
            // レンダーされ、レスポンスとして返される。
            // 第２引数にメッセージも渡せ、エラー表示ビュー中で
            // $exception->messageとしてアクセスできる。
            abort(401, 'このページヘアクセスする権限がありません。');
        }

        // ユーザーIDが1でログイン済みであれば次の処理へ。
        return $next($request);
    }
}
