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
        // Laravelではミドルウェアをコントローラーでも付加できる。
        //
        // auth.firstはこのチュートリアルのために作成した
        // カスタムミドルウェアで、認証済みでidが1の
        // ユーザーのみ通過させる。
        // ただし、通常特定IDを持つユーザーに権限を与えるのは、
        // セキュリティ的に脆弱になる。auth.firstはわかりやすさのため、
        // チュートリアル目的で用意した。
        //
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
        // ５レコードずつページネーション（ページ付け）するように取得
        $users = User::paginate(5);

        // 取得したページネーション情報付きのユーザーを渡し、
        // ビューディレクトリーの'user/index.blade.php'ファイルの
        // レンダー結果を内容としたResponseを返す。
        // この場合の「レンダー」とはビューの内容をHTMLへ変換すること。
        //
        // ビューのwithメソッドはビューに情報を渡す。この場合、
        // ビューの中で第１引数で渡された変数名で、第２引数の$usersが
        // 参照できる。
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
        // 用意してあれば404エラーページが表示される。
        $user = User::findOrFail($userId);

        // 取得できた場合は$userにEloquentモデルのインスタンスが
        // 入っている。deleteメソッドでそのユーザーのレコードは
        // テーブルから削除される。
        $user->delete();

        // 削除後、適当な場所へリダイレクトする。
        // リダイレクト先に直前のページをbackメソッドで指定している。
        // リダイレクトインスタンスに対するwithメソッドは、
        // 渡された情報をフラッシュデータとしてセッションへ保存する。
        //
        // フラッシュデータとは次のセッションの間だけ有効で、その後
        // 自動的に削除される保存データのこと。この例のように
        // エラーメッセージを渡したい場合に使用する。
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
        // EloqunetのfindOr Failメソッドは指定されたユーザーを取得するか、
        // 存在しない場合は例外を発生させる。
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

        // バリデーション実行。validateメソッドにより、指定された
        // バリデーションルールに全部合格しない限り、自動的に
        // 直前のページにリダイレクトされる。
        // その際、エラーメッセージと入力内容はセッションへ
        // フラッシュデータとして保存される。
        $this->validate($request, [
            'name' => 'required|max:255',
            // 更新時、ユーザー自身のメールアドレスとの重複は許す
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'password' => 'min:6',
        ]);

        // フォームへの入力内容は、送られてきたRequestに含まれている。
        // その中から、ユーザーに関する入力項目のみ配列で取得する。
        $inputs = \Request::only(['name', 'email', 'password']);

        // テーブルに保存しているパスワードはハッシュ済みであり、
        // 元の値に戻せない。そのためパスワードフィールドは入力専用。
        // 指定された場合のみ、入力内容をbcryptヘルパーでハッシュし、
        // 未指定の場合は保存されている内容のままにする。
        $inputs['password'] = empty($inputs['password']) ?
                $user->password : bcrypt($inputs['password']);

        // fillメソッドにより、配列の内容でEloquentモデルの内容を
        // 一度に置き換える。インスタンスがもつ項目値を設定するだけで、
        // まだデータベースへ保存はされていない。
        // テーブルのカラム名と、フォームの入力フィールド名を
        // 揃えてあるのがポイント。一々変換せずに一度に代入できる。
        //
        // Eloquentモデルのチュートリアルでかつて、リクエストの入力値を
        // 全て無条件に書き戻すコードが多く紹介されていた。しかし、
        // それではセキュリティーリスクを生むことがあるため、まとめて
        // 代入できる項目をモデルで制限する仕様となった。
        // 今回のname、email、passwordフィルードはUserクラスで指定済み。
        $user->fill($inputs);

        // インスタンスの内容でテーブルのレコードを書き換える。
        $user->save();

        // 処理終了後は適当な場所へリダイレクト
        // redirectヘルパーは引数にリダイレクト先のURLを受け取る。
        // actionヘルパーはコントローラー@アクションメソッドから、
        // URLを生成する。
        return redirect(action('UserController@getIndex'))
            ->with('status', 'ユーザー情報を変更しました。');
    }

}
