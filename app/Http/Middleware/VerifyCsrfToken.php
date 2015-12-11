<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

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
