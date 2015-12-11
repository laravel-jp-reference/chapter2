<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncrypter;

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
