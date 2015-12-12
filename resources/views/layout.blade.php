{{-- これはbladeのコメント記法で、レンダー後のHTMLには含まれない --}}
{{-- 各ページ共通のレイアウト --}}
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    {{-- 子のビューで指定される、titleセクションを読み込む --}}
    <title> @yield('title') </title>
    {{--
          Laravelの表示関係では、ペジネーション（ページ付け）の
          ページリンクがBootstrap CSSフレームワーク互換となっている。
          そのためこのチュートリアルでも当初はBootstrapを採用したが
          コードが煩雑になるため、構造がより単純なPure CSSフレームワークを
          今回は使用している。
    --}}
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      * { background-color: white; }
      div { margin-bottom: 1em; }
      div#content { padding: 1em; }

      /* メッセージ */
      .errors p, .status p {
          padding: 0.5em 0 0.5em 1.0em;
          border: solid 1px;
      }

      /* ペジネーション */
      ul.pagination li {
          display: inline-block;
          margin: 0.5em;
      }
      ul.pagination li.disabled { color: lightgray;}
      ul.pagination li.active { border-bottom: solid 1px;}
    </style>
  </head>
  <body>
    <div id="content" class="pure-g">
      {{--
          項目のバリデーションエラー以外のメッセージを表示する。
          statusキーは、Laravel組み込みのパスワードリセット機能で使われている。
          今回は、他のメッセージ表示でもstatusキーを活用する。
      --}}
      @if(session('status'))
      <div class="pure-u-1">
        <div class="status"><p>{{ session('status') }}</p></div>
      </div>
      @endif
      <div class="pure-u-1">
        {{-- 子のビューで指定される、contentセクションを読み込む --}}
        @yield('content')
      </div>
    </div>
  </body>
</html>
