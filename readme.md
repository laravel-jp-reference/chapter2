Laravelリファレンス ２章サンプルプロジェクト
============================================

このリポジトリはImpress社から発行されている、「Laravelリファレンス」の「02-02 初めてのアプリケーション(P.034)」で紹介しているサンプルプロジェクトです。インストール方法など詳細は書籍を参考にしてください。

* 設定はチュートリアル向けにしています。
*  * 認証情報を設定しなくても済むようにメールドライバーは開発時向けのlog、データベースドライバーはsqliteを使用しています。必要に応じ、変更してください。

* ユーザーのCRUD処理を実装しています。
*  * ユーザの作成はLaravel組み込みの認証機能のユーザー登録を利用しています。一覧表示、更新、削除処理はUserControllerクラスで行っています。

* Laravel組み込みの認証機能を利用しています。
*  * 本サンプルプロジェクト作成後にリリースされた、バージョン5.1.11の新機能である「認可」は使用していません。

* ユーザー登録時に「登録済み」メールを送っていますが、ユーザー情報を含むイベントを発行し、ハンドラーでメール送信処理を行っています。
*  * logドライバーを使用しているためメールは実際には送信されず、storage/logs/下のログファイルに書き込まれます。

* 例外をハンドラーで処理する方法やカスタムエラーページを実装しています。

* HTMLの構造がわかりやすいように、"master"ブランチではシンプルなPure CSSフレームワークを採用しています。

"master"以外のブランチは、名前が示すバリエーションです。"materialize"はPure CSSフレームワークの代わりに、Materialize CSSフレームワークを使用しています。"bootstrap"はBootstrapをCSSフレームワークに使用しています。

サンプルプロジェクトですので、わかりやすさを優先しています。アプリケーションとして完全な動作を保証するものではありません。
（たとえば、バリデーションの設定とデータベース上の項目の大きさは一致していません。
ユーザー一覧表示のページネーション表示で、最終ページでユーザーを全部削除していくと、ページ番号の割り付けに不具合が起きます。
本来は削除できなくするべきである最初のユーザーも削除できます。
変更を目視できるように、ユーザーの一覧ページにはパスワードのハッシュ値を表示しています。）

## インストール方法

以下の手順でインストールしてください。

#### 1. サンプルプログラムダウンロード

````
$ git clone https://github.com/laravel-jp-reference/chapter2.git 展開ディレクトリ名
````

> ※Impressからサンプルプログラムの圧縮ファイルをダウンロードし、展開した場合はコマンドを実行する必要ありません。

#### 2. 展開ディレクトリへ移動

前の手順でコードを展開したディレクトリーへ移動します。

````
$ cd 展開ディレクトリ名
````

#### 3. Laravelと依存コンポーネントダウンロード

Composerを用いて、Laravel本体と、動作に必要な依存コンポーネントをダウンロードします。

````
$ composer install
# もしくは
$ composer update
````

#### 4. .envファイルの設定

サンプル.envファイルをコピーし、.envファイルの内容を指定します。

````
$ cp .env.example .env
$ php artisan key:generate
````

このサンプルプログラムではユーザーのCRUD処理とユーザー認証を行うため、データベースを必要としています。
.envファイル中の「DBセッティング」項目を使用するデータベース環境に合わせ、設定してください。

デフォルトではデータベースの認証情報を指定しなくて済むようにSQLiteを指定してあります。
このままSQLiteを使用する場合は、データベースファイルを作成してください。

````
$ touch storage/database.sqlite
````

SQLite以外のデータベースを使用する場合は、あらかじめ使用するデータベースを作成しておく必要があります。
続いて、データベースエンジンに合わせてドライバー名をDB_CONNECTION項目に設定してください。
設定可能なドライバーは本文の表3.1(P.083)、もしくはconfig/database.phpファイルのconnections項目で確認してください。
更に、DB_DATABASE（データベース名）、DB_USERNAME（ユーザー名）、DB_PASSWORD（パスワード）も指定する必要があります。

データベースの設定が済んだら、必要なテーブルを生成するために「マイグレーション(本文3-2、P.086)」を行います。

````
$ php artisan migrate
````

Laravelのプロジェクトには、認証のために必要なusersテーブルを生成するマイグレーションがデフォルトで
app/database/migrationsディレクトリー下に用意されています。

#### 5. アプリケーションの設定

「2-1-3 アプリケーションの設定」(本文P.029)に従い、Laravelの環境を指定します。

本文のチュートリアルでは、Webサーバーを使わずPHP組み込みサーバーを利用する方法を紹介しています。

````
$ php artisan serve
````

この方法で動作させる場合、これ以上の設定は必要ありません。

組み込みサーバーを使用せず、Webサーバーで動作させる場合は「ディレクトリーパーミッションの設定(P.029)」を行う必要があります。本文でも記述していませんが、もちろん仮想ホストなどを設定し、ドキュメントルートをプロジェクトのpublicディレクトリに設定する必要もあります。

ブラウザからアクセスして、表示を確認してください。PHP組み込みサーバーを利用する場合は、http://localhost:8000 にアクセスします。
Webサーバーを利用する場合は、設定したURLへアクセスしてください。

正しく動作していれば、シンプルなトップページが表示されます。（印刷用に作成したため、白黒です。）

#### 6. ユーザーの作成

このチュートリアルでは、ユーザー情報を操作できる管理者は、最初に作成したユーザー（データベース上のid項目の値が1であるユーザー）にしています。このユーザーを作成するため、ユーザー登録ボタンをクリックし
（PHP組み込みサーバーを使用する場合はhttp://localhost:8000/auth/register）、ユーザーを作成してください。

さらに、ページネーション（ページ付け）の動作を確認するには、ユーザーを合計で６人分以上作成する必要があります。
データベースの初期値を設定するためLaravelに用意されている、「3-2-5 シーダー」(P.095)を用いて５０人分のユーザーを一度に追加することも可能です。

````
$ php artisan db:seed
````

生成されるデータはランダムなもので、「6-3 モデルファクトリ」(P.313)の機能を利用しています。
他のユーザーでもログインして試せるように、生成ユーザーのパスワードは全部"password"にしています。

## 修正点

初期状態のプロジェクトに対し、どこに手を入れてあるかを確認するにはgit diffを利用してください。

~~~
git diff init master
~~~

変更を確認するには、ルート定義のapp/Http/routes.phpファイル、
２つのコントローラ（app/Http/Controllers/HomeController.php、app/Http/Controllers/UserContoller.php)
から確認すると、要点がつかみやすいでしょう。

ビューを読むときはまず全体のレイアウトのresources/views/layout.blade.phpと、
コメントを特に多く入れているログインビューのresources/views/auth/login.blade.phpファイルから
調べると、理解しやすいでしょう。

## ライセンス

このプロジェクトファイルはImpress社から出版されている「Laravelリファレンス」を補助する内容です。そのため、このreadme.mdファイルのみ、川瀬裕久による通常の著作物です。

LaravelはMITライセンスの元に公開されています。作者はTaylor Otwellさんです。このサンプルプロジェクトは、GitHubで公開されているlaravel/laravelリポジトリーの内容をベースとしています。

このサンプルプログラムに含まれる設定ファイルやクラスのコメントはGitHubで公開しているlaravel-ja/comja5を利用し、日本語に翻訳しています。Comja5はMITライセンスのもとに公開しています。作者は川瀬裕久です。

readme.mdを除く、このサンプルプログラムはMITライセンスのもとに公開しています。作者は川瀬裕久です。
