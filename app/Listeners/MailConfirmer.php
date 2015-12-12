<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Mail\Mailer;

class MailConfirmer
{
    /**
     * @var Illuminate\Contracts\Mail\Mailer メーラーインスタンス
     */
    private $mailer;

    /**
     * コンストラクター
     *
     * メール操作はファサードを使っても簡単だが、
     * ここではコンストラクターインジェクションを使うサンプルとした。
     * イベントリスナーはサービスコンテナによりインスタンス化される。
     * その際、コンストラクターの引数でタイプヒントを使用すると、
     * そのクラスのインスタンスを渡してくれる。
     *
     * 参照 :
     *   本文 : 「5-1 サービスコンテナ」(P.244)
     *   ドキュメント : http://readouble.com/laravel/5/1/ja/container.html
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * ユーザー登録イベントの処理
     *
     * ユーザー登録を知らせるメールを送信する。
     *
     * @param UserRegistered $event
     */
    public function handle(UserRegistered $event)
    {
        // App\Userのインスタンスを取得
        $user = $event->user;

        // 登録済み通知メール送信
        $this->mailer->send('emails.register',
            ['name' => $user->name],
            function ($mail) use ($user) {
                $mail->to($user->email, $user->name)
                    ->subject('ユーザー登録のお知らせ');
            });
    }
}
