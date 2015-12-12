<?php

namespace App\Events;

use App\User;
use Illuminate\Queue\SerializesModels;

/**
 * 新規ユーザー登録イベント
 *
 * 新しいユーザーが作成された時に、App\Http\Controllers\AuthControllerから
 * 発行されるイベント。イベントを利用する利点は以下の通り。
 *
 *   １．機能を独立させる、
 *   ２．機能追加／削除が簡単に実現可能になる
 *
 * イベントは発行されるとLaravelにより、App\Providers\EventServiceProviderで登録
 * されているリスナーへ届けられる。
 *
 * 識別のために利用されるLaravelのイベント名は、もともと文字列ベースである。
 * 情報は配列で渡されていた。機能拡張され、クラスインスタンスを
 * 取り扱えるようになり、カプセル化できるようになった。
 *
 * イベント参照 :
 *   本文 : 「4-5 イベント」(P.190)
 *   ドキュメント : http://readouble.com/laravel/5/1/ja/events.html
 */
class UserRegistered extends Event
{
    // Eloquentモデルは様々な情報を含んでおり大きい。
    // そのままシリアライズすると更に大きくなり、キューの最大値を
    // 超える可能性がある。また、シリアライズ／非シリアライズが
    // 正しく行えない情報を含んでいることもある。
    // そのため、シリアライズ時はidの値だけを保持し、
    // 非シリアライズ時にデータベースから再取得する仕組みが提供されている。
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
