<?php

namespace App\Events;

use App\User;
use Illuminate\Queue\SerializesModels;

/**
 * 新規ユーザー登録イベント
 *
 * 新しいユーザーが作成された時に、App\Http\Controllers\AuthControllerから
 * 発行されるイベント。イベントを利用する利点は以下の通り。
 *   １．機能を独立させる、
 *   ２．機能追加／削除が簡単に実現可能になる
 * イベントは発行されるとLaravelにより、App\Providers\EventServiceProviderで登録
 * されているリスナーへ届けられる。
 */
class UserRegistered extends Event
{
    use SerializesModels;

    /**
     * @var App\User 新規登録ユーザー
     */
    public $user;

    /**
     * ユーザー生成イベントコンストラクタ
     *
     * イベント自身は特別なクラスではない。
     * 最低限データを保持するだけ。
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
