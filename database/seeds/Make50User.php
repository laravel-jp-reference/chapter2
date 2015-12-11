<?php

use Illuminate\Database\Seeder;

/**
 * ファクトリーを使いユーザーを50人分追加
 */
class Make50User extends Seeder
{
    /**
     * シーディング（初期値設定）実行
     */
    public function run()
    {
        // ファクトリーを使用し、ユーザーを５０件作成する。
        // パスワードを全部、'password'に設定する。
        // ファクトリーの生成するデフォルトデータを
        // 上書きするときはmakeの引数に配列で指定する。
        $users = factory('App\User', 50)->make([
            'password' => bcrypt('password'),
        ]);

        // EloquentモデルのUserインスタンスを保存、
        // eachはコレクションメソッド。
        // foreachで回すこともできる。
        $users->each(function ($item) {
            $item->save();
        });
    }
}
