<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Validator;

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
        // ユーザー追加に関わる機能の拡張は
        // このメソッドをいじらず簡単にできるようになる。
        // イベントと処理するリスナーは
        // App\Providers\EventServiceProviderに登録する。
        event(new UserRegistered($user));

        return $user;
    }
}
