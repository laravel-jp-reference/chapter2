<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncrypter;

/**
 * 受け取ったリクエストのクッキーを複合し、
 * 送信するレスポンスのクッキーは暗号化する。
 */
class EncryptCookies extends BaseEncrypter
{
    /**
     * 暗号化しないクッキーの名前
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
