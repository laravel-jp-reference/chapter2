<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

/**
 * Laravelプロジェクトにデフォルトで含まれているEloquentユーザーモデル
 *
 * 認証（ログイン）時に、Auth::userメソッドなど認証ユーザーのデータを取得する場合、
 * デフォルト設定で取得できるクラス。
 *
 * 参照 :
 *   本文 : 「4-1 認証」(P.156)
 *          「3-5 Eloquent ORM」(P.121)
 *   ドキュメント : http://readouble.com/laravel/5/1/ja/authentication.html#retrieving-the-authenticated-user
 *                  http://readouble.com/laravel/5/1/ja/eloquent.html
 */
class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * モデルで使用するデータベーステーブル
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * 複数代入を行う属性
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * モデルのJSON形式に含めない属性
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
}
