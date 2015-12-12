<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * サイトホーム（トップ）ページ表示ルート
     *
     * URI : GET /
     *
     * @return string
     */
    public function index()
    {
        // viewヘルパーは引数で指定されたビューファイルを元に
        // viewインスタンスを生成し返す。
        // コントローラーから返されたviewインスタンスは
        // レンダー（この場合ビューをHTMLへ変換すること）され
        // その内容のResponseに変換される。
        //
        // 文字列や今回のようにviewインスタンスを返す場合、
        // HTTPステータスコードは200となる。200以外を返す場合は
        // Responseインスタンスで返す。
        //
        // 例 : return response(view('front'), 401);
        //
         return view('front');
    }

    /**
     * 認証済みユーザー専用ページ
     *
     * URI : GET /home
     *
     * @return RedirectResponse
     */
    public function home()
    {
        // ルート定義によりauthミドルウェアが指定されているため、
        // ログイン済みのユーザーしか、このページを見ることができない。
        // 未ログインのユーザーは、自動的にログインページに
        // リダイレクトされる。認証に成功すると、自動的に
        // このルートへ戻ってきて、ページが表示される。
        return view('user-only');
    }
}
