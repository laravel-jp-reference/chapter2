<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

/**
 * HTTPリクエストメソッドが'HEAD'、'GET'、'OPTIONS'以外の場合に、
 * リクエストに含まれているCSRFトークンがセッションに保存していた値と
 * 一致することを確認するミドルウェア
 *
 * 不一致の場合はIlluminate\Session\TokenMismatchException例外が
 * 投げられる。
 */
class VerifyCsrfToken extends BaseVerifier
{
    /**
     * CSRFの確認を除外するURI
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
