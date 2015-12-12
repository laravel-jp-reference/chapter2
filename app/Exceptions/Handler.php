<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Laravel例外処理ハンドラークラス
 *
 * 参照：
 *   本文 : 「4-3 エラーハンドリング」(P.181)
 *   ドキュメント : http://readouble.com/laravel/5/1/ja/errors.html
 */
class Handler extends ExceptionHandler
{
    /**
     * レポートしない例外タイプのリスト
     *
     * ここに列記した例外以外は全部reportメソッドに通知される。
     * 逆に言えば、通知やログ処理する必要がない例外をここで指定する。
     *
     * @var array
     */
    protected $dontReport = [
        // HTTPのステータスコードを通知する例外は取り扱わない
        HttpException::class,
        // Eloquentが発生させるレコードがIDで見つけられない例外は
        // 取り扱わない
        ModelNotFoundException::class,
    ];

    /**
     * 例外をレポート、もしくはログ
     *
     * ここはSentryやBugsnagなどに例外を送るために良い場所
     *
     * @param \Exception $e
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * HTTPレスポンスに対応する例外をレンダー
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        // CSRFトークンが存在しない、トークン不一致時に投げられる。
        // TokenMismatchException例外を403で処理。
        // もちろん適切であれば、HTTPステータスは自由に設定できる。
        if ($e instanceof TokenMismatchException) {
            // abortヘルパーによりSymfony\Component\HttpFoundation\Exception\HttpException例外が
            // 投げられ、再度このrenderメソッドで処理される。この例外の
            // ステータスコードに一致するビューがapp/resources/views/errorsに
            // 存在していれば、そのビューが表示される。今回は403.blade.phpファイルが
            // 存在しているため、このファイルの内容がエラーページとして表示される。
            abort(403);
        }

        // このrenderメソッドに最初から含まれている処理。
        // EloquentのfindOrFailソッドなどが投げるModelNotFoundException例外を
        // 404エラーにしている。
        if ($e instanceof ModelNotFoundException) {
            // 404エラー例外はabort(404)を使わず、次のように発生可能。
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        return parent::render($request, $e);
    }
}
