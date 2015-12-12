{{-- これはbladeのコメント記法で、レンダー後のHTMLには含まれない --}}
{{-- 各ページ共通のレイアウト --}}
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    {{-- 子のビューで指定される、titleセクションを読み込む --}}
    <title> @yield('title') </title>
    {{-- BootstrapをCDNから読み込む --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    {{-- ナビバー --}}
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        {{-- モバイル時 --}}
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            {{-- モバイルの横棒３本アイコン --}}
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">UserモデルCRUDサンプル</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li class="{!! Request::is('/') ? 'active' : '' !!}">
              <a href="{!! url('/') !!}"><span class="glyphicon glyphicon-home"></span> ホーム</a>
            </li>
            @if(Auth::guest())
            <li class="{!! Request::is('auth/register') ? 'active' : '' !!}">
              <a href="{!! url('auth/register') !!}"><span class="glyphicon glyphicon-user"></span> ユーザー登録</a>
            </li>
            <li class="{!! Request::is('auth/login') ? 'active' : '' !!}">
              <a href="{!! url('auth/login') !!}"><span class="glyphicon glyphicon-log-in"></span> ログイン</a>
            </li>
            @else
            {{-- ユーザーIDが1の管理者専用領域、他の登録ユーザーではアクセスできないことを確認するためのリンク --}}
            <li class="{!! Request::is('user') || Request::is('user/*') ? 'active' : '' !!}">
              <a href="{!! url('user') !!}"><span class="glyphicon glyphicon-cog"></span> ユーザー管理</a>
            </li>
            <li>
              <a href="{!! url('auth/logout') !!}"><span class="glyphicon glyphicon-log-out"></span> ログアウト</a>
            </li>
            @endif
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div class="container">
      {{-- パンくずリスト --}}
      <div class="row">
        <div class="col-sm-12">
          <ol class="breadcrumb">
            <li class="{!! Request::is('/') ? 'active' : '' !!}">
              @if(Request::is('/'))
              <span class="glyphicon glyphicon-home"></span>
              @else
              <a href="{!! url('/') !!}"><span class="glyphicon glyphicon-home"></span></a>
              @endif
            </li>
            @yield('breadcrumb')
          </ol>
        </div>
      </div>
      {{--
          項目のバリデーションエラー以外のメッセージを表示する。
          statusキーは、Laravel組み込みのパスワードリセット機能で使われている。
          今回は、他のメッセージ表示でもstatusキーを活用する。
      --}}
      <div class="row">
        <div class="col-sm-12">
          @if(session('status'))
          <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('status') }}
          </div>
          @endif
          {{-- 子のビューで指定される、contentセクションを読み込む --}}
          @yield('content')
        </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>

</html>
