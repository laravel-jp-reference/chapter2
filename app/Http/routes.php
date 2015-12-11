<?php

/*
|--------------------------------------------------------------------------
| アプリケーションのルート
|--------------------------------------------------------------------------
|
| ここでアプリケーションのルートを全て登録することが可能です。
| 簡単です。ただ、Laravelへ対応するURIと、そのURIがリクエスト
| されたときに呼び出されるコントローラーを指定してください。
|
*/

//
// アクセスされたURLとHTTPメソッドにより、特定のロジックに制御を渡すことを
// 「ルーティング」と言います。
//
// ルーティング参照 :
//   本文 : 2-2-3 はじめてのルート定義 (P.040)
//   ドキュメント : http://readouble.com/laravel/5/1/ja/routing.html
//
// Laravelでは、基本的にこのroutes.phpでルートを定義します。
//

//
// GET /のルート定義
//
// ホーム（トップページ）表示
//
// ルートを定義するには、Route::に続けHTTPアクセスメソッド（GETやPOSTなど）を
// メソッド名として定義する。第一引数はURI。URIのないトップページは'/'で表す。
// 第二引数はコントローラーメソッド名@アクションメソッド名。
// アクションメソッドとは、ルーティングを担当するルーターから呼び出される
// publicのメソッドのこと。
//
// 下の定義ではURIのないトップページにGET HTTPメソッドでアクセスされた場合に、
// ルーターがHomeControllerコントローラークラスのindexメソッドを呼び出す。
//
Route::get('/', 'HomeController@index');

//
// GET /homeのルート定義
//
// ログインしたユーザーのみアクセス可能なページの定義サンプル
//
// Laravelでは認証（ログイン）済みユーザーのみ、このルートへ
// アクセス可能にしたい場合、'auth'ミドルウェアを使用してルートを定義する。
//
// ミドルウェア参照 :
//   本文 : 2-3-5 ミドルウェア (P.064)
//   ドキュメント : http://readouble.com/laravel/5/1/ja/middleware.html
//
// 'auth'ミドルウェアの定義 : app/Http/Kernel.php $routeMiddlewareプロパティ
// 'auth'ミドルウェアの実体 : app/Http/Middlewears/Authenticate.php
//
// 下と同じ定義：Route::get('home', 'HomeController@home')->middleware(['auth']);
Route::get('home', ['middleware' => 'auth', 'uses' => 'HomeController@home']);

//
// 以下のURIを定義
//
//   GET  /user                   ユーザー一覧表示
//   GET  /user/edit/ユーザーID   ユーザー更新フォーム表示
//   POST /user/edit/ユーザーID   ユーザー更新処理
//   GET  /user/remove/ユーザーID ユーザー削除
//
// controllerメソッドはURIの先頭とコントローラーを結びつける。どのルートと結び付けるのか
// コントローラーを確認する必要がある。
//
// 暗黙のコントローラー参照 :
//   本文 : P.061
//   ドキュメント : http://readouble.com/laravel/5/1/ja/controllers.html#implicit-controllers
//
// コントローラーで指定しているミドルウェアにより、
// idが'1'のユーザー（最初の登録ユーザー）のみアクセス可能。
//
Route::controller('user', 'UserController');

//
// 以下のURIを定義
//
//   GET  /auth/register            ユーザー登録フォーム表示（ユーザー追加）
//   POST /auth/register            ユーザー登録処理
//   GET  /auth/login               ユーザー認証（ログイン）フォーム表示
//   POST /auth/login               ユーザー認証処理
//   GET  /auth/logout              ログアウト
//   GET  /password/email           パスワードリセットメール依頼フォーム表示
//   POST /password/email           パスワードリセットメール処理
//   GET  /password/reset/トークン  パスワードリセットフォーム表示
//   POST /password/reset           パスワードリセット
//
Route::controllers([
    'auth'     => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

//
// ※注意
//
// Laravel5.2より上記controllerメソッドとcontrollersメソッドの両方共、
// 非推奨となった。今後はRoute::を使用し、個別に定義する必要がある。
//
// 個別のルート定義 :
//   http://readouble.com/laravel/5/1/ja/authentication.html#included-routing
//   http://readouble.com/laravel/5/1/ja/authentication.html#resetting-routing
//
