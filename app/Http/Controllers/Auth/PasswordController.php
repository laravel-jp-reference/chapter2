<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * パスワードリセット処理
 *
 * Laravel組み込みのリセット処理クラス。
 *
 * 参照 :
 *   本文 : 「4-1 認証」(P.156)
 *   ドキュメント : http://readouble.com/laravel/5/1/ja/authentication.html
 */
class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | パスワードリセットコントローラー
    |--------------------------------------------------------------------------
    |
    | このコントローラーはパスワードリセットリクエストの処理に責任を持ち、その
    | 振る舞いを取り込むために、シンプルなトレイトを使用しています。望み通りに
    | 調整するため、このトレイトを使い、メソッドをオーバーライドしてください。
    |
    */

    use ResetsPasswords;

    /**
     * 新しいパスワードコントローラーインスタンスの生成
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
