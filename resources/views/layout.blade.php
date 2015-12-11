{{-- これはbladeのコメント記法で、レンダー後のHTMLには含まれない。 --}}
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- CDNからMatrialize CSSフレームワークを取り込む --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    {{-- 子のビューで指定される、titleセクションを読み込む --}}
    <title> @yield('title') </title>
    {{-- 調節 --}}
    <style>
      body {
          background-color: #f9f9f9;
      }
      /* 項目の入力補助とエラーメッセージ */
      p.error-msg {
          color: #DD2C00 !important;
          font-size: 0.7em;
          margin-top: -1em !important;
      }
      p.help-msg {
          color: #9e9e9e !important;
          font-size: 0.7em;
          margin-top: -1em !important;
      }
      /* 入力エラー時はボーダーを赤に */
      input.error {
          border-bottom: 1px solid #DD2C00;
      }
      /* ナビのアイコンと文字がずれるのを修正 */
      ul#mobile-nav li a i {
          vertical-align: top;
      }
      nav .nav-wrapper i {
          display: inline-block;
      }
      /* トーストをスナックバーらしく */
      /* モバイルで横幅一杯 */
      #toast-container {
          display: block;
          position: fixed;
          width: 100%;
          z-index: 1001;
      }
      @media only screen and (min-width: 601px) {
          #toast-container {
              top: auto;
              left: calc(100% / 2 - 288px / 2);
              bottom: 0;
          }
          .toast {
              min-width: 288px;
              float: left;
          }
      }
      /* ロゴが左につきすぎる修正 */
      @media only screen and (min-width: 601px) {
          nav .brand-logo {
              padding-left: 0.50em; }
      }
      /* クロームのオートフィル背景色上書き */
      input:-webkit-autofill {
          -webkit-box-shadow: 0 0 0px 1000px white inset;
      }

    </style>
  </head>
  <body>
    {{-- ナビゲーション デスクトップ／タブレット時の上部表示 --}}
    <nav>
      <div class="nav-wrapper">
        <div class="brand-logo">@yield('page')</div>
        <a href="#" data-activates="mobile-nav" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <li>
            <a class="waves-effect tooltipped" data-position="bottom"
               data-delay="50" data-tooltip="ホーム" href="{!! url('/') !!}">
              <i class="large material-icons">home</i>
            </a>
          </li>
          @if (Auth::guest())
          <li>
            <a class="waves-effect tooltipped" data-position="bottom"
               data-delay="50" data-tooltip="ユーザー登録" href="{!! url('auth/register') !!}">
              <i class="large material-icons">open_in_new</i>
            </a>
          </li>
          <li>
            <a class="waves-effect tooltipped" data-position="bottom"
               data-delay="50" data-tooltip="ログイン" href="{!! url('auth/login') !!}">
              <i class="large material-icons">account_box</i>
            </a>
          </li>
          @else
          {{-- ユーザーIDが1の管理者のみアクセス可能なリンクだが、アクセスできないことを示すためあえてログインユーザー全員に対し表示している --}}
          <li>
            <a class="waves-effect tooltipped" data-position="bottom"
               data-delay="50" data-tooltip="管理者領域" href="{!! url('user') !!}">
              <i class="large material-icons">supervisor_account</i>
            </a>
          </li>
          <li>
            <a class="waves-effect tooltipped" data-position="bottom"
               data-delay="50" data-tooltip="ログアウト" href="{!! url('auth/logout') !!}">
              <i class="large material-icons">exit_to_app</i>
            </a>
          </li>
          @endif
        </ul>
        {{-- ナビゲーション モバイル時の左ナビ --}}
        <ul class="side-nav" id="mobile-nav">
          <li><a class="waves-effect" href="{!! url('/') !!}"><i class="material-icons">home</i> ホーム</a></li>
          @if (Auth::guest())
          <li><a class="waves-effect" href="{!! url('auth/register') !!}"><i class="material-icons">open_in_new</i> ユーザー登録</a></li>
          <li><a class="waves-effect" href="{!! url('auth/login') !!}"><i class="material-icons">account_box</i> ログイン</a></li>
          @else
          {{-- ユーザーIDが1の管理者のみアクセス可能なリンクだが、アクセスできないことを示すためあえてログインユーザー全員に対し表示している --}}
          <li><a class="waves-effect" href="{!! url('user') !!}"><i class="material-icons">supervisor_account</i> 管理者領域</a></li>
          <li><a class="waves-effect" href="{!! url('auth/logout') !!}"><i class="material-icons">exit_to_app</i> ログアウト</a></li>
          @endif
        </ul>
      </div>
    </nav>
    {{--
          エラー以外のメッセージ。
          statusはパスワードリセットで使われている。
        --}}
    @if(session('status'))
    <div class="row z-depth-1">
      <div class="col s12 orange lighten-1">
        <div class="status"><p>{{ session('status') }}</p></div>
      </div>
    </div>
    @endif
    {{-- 子のビューで指定される、contentセクションを読み込む --}}
    <div class="row">
      <div class="col s12">
        <div class="card">
          <div class="card-content black-text">
            @yield('content')
          </div>
        </div>
      </div>
    </div>
    {{-- materialize.jsの前にjQueryが必要 --}}
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    {{-- materialize.jsをCDNから読み込む --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
    {{-- トーストを使用し、infoメッセージを出力 --}}
    <script type="text/javascript">
        $(document).ready(function () {
$(".button-collapse").sideNav();
        @if (session('info'))
        Materialize.toast("{{ session('info') }}", 4000);
        @endif
        });
    </script>

  </body>
</html>
