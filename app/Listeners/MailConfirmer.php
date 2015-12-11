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
     * ここではコンストラクターインジェクションを
     * 使うサンプルとした。
     * イベントリスナーはサービスプロバイダーにより
     * インスタンス化される。その際、コンストラクターの
     * 引数でタイプヒントを使用すると、そのクラスの
     * インスタンスを渡してくれる。
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * ユーザー登録イベントの処理
     *
     * 登録済みの旨を知らせるメールを送信する。
     *
     * @param UserRegistered $event
     */
    public function handle(UserRegistered $event)
    {
        // App\Userのインスタンスを取得
        $user = $event->user;

        // 登録済みメール送信
        $this->mailer->send('emails.register',
            ['name' => $user->name],
            function ($mail) use ($user) {
                $mail->to($user->email, $user->name)
                    ->subject('ユーザー登録のお知らせ');
            });
    }
}
