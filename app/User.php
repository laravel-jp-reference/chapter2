<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

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
