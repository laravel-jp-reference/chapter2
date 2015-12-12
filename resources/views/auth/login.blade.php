{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
ログイン:UserモデルCRUDサンプル
@endsection

@section('page')
ログイン
@endsection

@section('content')
<div class="row">
  {{-- actionのURLをコントローラーとアクションを指定し生成 --}}
  <form class="col s12" method="POST">

    {{-- emailフィールド --}}
    <div class="row">
      <div class="col s12 input-field">
        <input id="email" type="email" name="email" value="{{ old('email') }}" length="255"
               class="{{ $errors->has('email') ? 'error' : '' }}">
        <label for="email">メールアドレス</label>
        {{--
          @ifから@endifの間で、emailフィールドに対するバリデーションエラーを表示している。

          ビューの$errors変数は必ず存在し、MessageBagインターフェイスを実装している。
          通常これにはバリデーションのエラーが渡される。エラー発生時のリダイレクトに
          対しwithErrorsメソッドを付けると、MessageBagがセッション経由でビューに
          渡る。セッションに保存されていない場合でも、メッセージを含まないMessageBagが
          生成され、$errorsにセットされる。
        --}}
        @if ($errors->has('email'))
        <p class="error-msg">{{ $errors->first('email') }}</p>
        @else
        <p class="help-msg">登録したあなたのメールアドレスを指定してください。</p>
        @endif
      </div>
    </div>

    {{-- passwordフィールド --}}
    <div class="row">
      <div class="col s12 input-field">
        {{--
          セキュリティのプラクティスに従い、
          パスワードの入力値は表示しない = レスポンスへ含めない
        --}}
        <input id="password" type="password" name="password"
               class="{{ $errors->has('password') ? 'error' : '' }}">
        <label for="password">パスワード</label>
        @if ($errors->has('password'))
        <p class="error-msg">{{ $errors->first('password') }}</p>
        @else
        <p class="help-msg">もしパスワードを忘れた時は、一番下のボタンを利用してください。</p>
        @endif
      </div>
    </div>

    {{-- ログインボタン --}}
    <div class="row">
      <div class="col s12 input-field">
        <button class="btn waves-effect" type="submit" name="action">
          ログイン <i class="material-icons right">send</i>
        </button>
      </div>

      {{-- remembe me（継続ログイン）の有効無効指定チェックボックス --}}
      <div class="col s12 input-field">
        <input id="remember" type="checkbox" name="remember"
        {{-- remember入力項目が存在しているならば、チェックされている --}}
        {!! old('remember') ? 'checked="checked"' : '' !!} >
        <label for="remember">ログインしたままにする</label>
      </div>
    </div>

    <div class="divider"></div>

    {{-- パスワードリセットボタン --}}
    {{--
      ルートURLにサブディレクトリーが含まれる場合を考慮し、
      URIをリンク先に指定する場合でもurlヘルパーでフルURLを生成する。

      今回は静的にURLを生成しているだけのため問題はないが、
      スラグなどで生成URLへユーザー入力を含める場合、
      URL生成系ヘルパーやクラスの使用時には、セキュリティや不具合に
      考慮して適切にフィルタリングを行う。
      たとえばシンプルな例では、ユーザーがタイトルに"/"を含め、それを
      直接スラグにすると、URL上ではセグメントの分割になり、ルート定義に
      一致しなくなる可能性が出る。
    --}}

    <div class="row">
      <div class="col s12 input-field">
        <a class="btn waves-effect waves-light" href="{!! url('/password/email') !!}">
          パスワードを忘れました
        </a>
      </div>
    </div>

    {{--
      CSRFを防ぐためのトークンを隠しフィールドに埋め込むコードの生成。
      トークンの値チェックは毎回セッションごとに適用される
      VerifyCsrfTokenグローバルミドルウェアで行っている。

      参照 :
        本文 : 「7-1-3 CSRF対策」(P.749)
        ドキュメント : http://readouble.com/laravel/5/1/ja/routing.html#csrf-protection
    --}}
    {!! csrf_field() !!}
  </form>
</div>
@endsection
