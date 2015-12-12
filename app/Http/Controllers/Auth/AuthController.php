<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Validator;

/**
 * Laravel組み込みの認証（ログイン）コントローラー
 *
 * 実際にはユーザー認証とユーザー登録の２つの役目を持っている。
 *
 * 参照 :
 *   本文 : 「4-1 認証」(P.156)
 *   ドキュメント : http://readouble.com/laravel/5/1/ja/authentication.html
 */
class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers,
        ThrottlesLogins;

    /**
     * 新しい認証コントローラインスタンスの生成
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * やって来た登録リクエストに対するバリデターを取得
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data,
                [
                'name'     => 'required|max:255',
                'email'    => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * 登録内容を確認後、新しいユーザーインスタンスを生成
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => bcrypt($data['password']),
        ]);

        // ユーザー生成イベント発行
        // イベントを受け取るリスナーを登録することで
        // ユーザー追加時に関わる機能の拡張は
        // このメソッドを直接変更せずにリスナーで簡単に
        // できるようになる。イベントと処理するリスナーは
        // App\Providers\EventServiceProviderに登録する。
        event(new UserRegistered($user));

        return $user;
    }
}
