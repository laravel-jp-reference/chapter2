<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

/**
 * ユーザーのCRUD処理
 *
 * 生成（Create）はLaravel組み込みの認証機能が持つ「ユーザー登録」で行う。
 * ここでは残りの表示（一覧）、削除、編集更新を実装する。
 */
class UserController extends Controller {

    /**
     * コンストラクタ
     */
    public function __construct() {
        // Laravelではミドルウェアをコントローラーで付加できる。
        // auth.firstはこのチュートリアルのために作成した
        // カスタムミドルウェアで、認証済みでユーザーIDが1の
        // ユーザーのみ通過させる。
        // ただし、特定IDを持つユーザーに権限を与えるのは、
        // セキュリティが弱い。auth.firstはチュートリアル目的で
        // 用意した。
        // auth.firstの実体は、App\Http\Middleware\FirstUserで
        // App\Http\Kernelクラスで登録している。
        $this->middleware('auth.first');
    }

    /**
     * ユーザー一覧表示
     *
     * URI : GET /user
     *
     * URIが/userだけで、アクションメソッドが指示されない場合、
     * HTTP動詞+Indexのアクションメソッドが実行される。
     *
     * @return Response
     */
    public function getIndex() {
        // ５レコードずつペジネーション（ページ付け）するように取得
        $users = User::paginate(5);

        // 取得したペジネーション情報付きのユーザーを渡し、
        // ビューディレクトリーの'user/index.blade.php'ファイルの
        // レンダー結果を内容としたResponseを返す。
        // この場合の「レンダー」とはビューの内容をHTMLへ変換すること。
        return view('user.index')->with('users', $users);
    }

    /**
     * ユーザー削除
     *
     * URI : GET /user/remove/ユーザーID
     *
     * 指定されたユーザーを削除する。
     *
     * @param int $userId
     * @return RedirectResponse
     */
    public function getRemove($userId) {
        // ユーザーを取得する。指定されたユーザーが存在しない場合
        // ModelNotFoundException例外が発生する。この例外は
        // App\Exceptions\Handlerで404HTTP例外に変換され、
        // 404エラーページが表示される。
        $user = User::findOrFail($userId);

        // 取得できた場合は$userにEloquentモデルのインスタンスが
        // 入っている。deleteメソッドでそのユーザーのレコードは
        // テーブルから削除される。
        $user->delete();

        // 削除後、適当な場所へリダイレクトする。
        // リダイレクト先に直前のページをbackメソッドで指定している。
        // リダイレクトインスタンスに対するwithは、セッションへの保存。
        // この場合、メッセージをstatusキーで保存している
        return redirect()->back()
            ->with('status', 'ユーザーを削除しました。');
    }

    /**
     * ユーザーの登録内容更新フォーム表示
     *
     * URI : GET /user/edit/ユーザーID
     *
     * ユーザーの登録内容を修正するフォームを表示
     *
     * @param int $userId
     * @return Response
     */
    public function getEdit($userId) {
        // 指定されたユーザーを取得、存在しない場合は
        // 例外が発生する。
        $user = User::findOrFail($userId);

        // ビューファイルの'user/edit.blade.php'の内容を
        // レンダーした結果で、Responseが生成される。
        // withUserは動的なメソッド指定によりwithメソッドを
        // 呼び出す方法で、with+変数名のメソッド名として指定する。
        // この場合はwith('user', $user)と同じ動作をする。
        return view('user.edit')->withUser($user);
    }

    /**
     * ユーザーの登録処理
     *
     * POST : GET /user/edit/ユーザーID
     *
     * 内容の編集フォームから送られてきた内容で
     * ユーザーを更新する。
     *
     * @param int $userId
     * @return RedirectResponse
     */
    public function postEdit(Request $request, $userId) {
        // 指定されたユーザーを取得、存在しない場合は
        // 例外が発生する。
        $user = User::findOrFail($userId);

        // バリデーション実行。validateメソッドにより自動的に
        // バリデーションエラー発生時は前のページに戻される。
        // その際、エラーメッセージと入力内容はセッションへ
        // 次のリクエストの処理中のみ存在するフラッシュデータと
        // して保存される。
        $this->validate($request, [
            'name' => 'required|max:255',
            // 更新時、ユーザー自身のメールアドレスとの重複は許す
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'password' => 'min:6',
        ]);

        // フォームの指定内容はRequestに含まれている。
        // その中から、ユーザーに関する入力項目のみ配列で取得する。
        $inputs = \Request::only(['name', 'email', 'password']);

        // テーブルに保存しているパスワードはハッシュ済みであり、
        // 元の値に戻せない。もし戻せるとしても、サーバーサイド
        // から送り返すのは安全性からよくない。そのためパスワード
        // フィールドは入力専用。指定された場合のみ、入力内容を
        // bcryptヘルパーでハッシュすし、未指定の場合は
        // 保存されている内容のままにする。
        $inputs['password'] = empty($inputs['password']) ?
                $user->password : bcrypt($inputs['password']);

        // 指定する配列の内容でEloquentモデルの内容を置き換える。
        // インスタンスの中身を変えるだけで、保存はされない。
        // テーブルのカラム名と、フォームの入力フィールド名を
        // 揃えてあるのがポイント。一々変換せずに一度に代入できる。
        $user->fill($inputs);

        // インスタンスの内容でレコードを書き換える。
        $user->save();

        // 処理終了後は適当な場所へリダイレクト
        // redirectヘルパーは引数にリダイレクト先のURLを受け取る。
        // actionヘルパーはコントローラー@アクションメソッドから、
        // URLを生成する。
        return redirect(action('UserController@getIndex'))
            ->with('status', 'ユーザー情報を変更しました。');
    }

}
