{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
ログイン:UserモデルCRUDサンプル
@endsection

@section('content')
<h1>ログイン</h1>

<form class="pure-form pure-form-aligned" method="POST">
  <fieldset>

    {{-- nameフィールド --}}
    <div class="pure-control-group">
      {{--
        @ifから@endifの間で、emailフィールドに対するバリデーションエラーを表示している。

        ビューの$errors変数は必ず存在し、MessageBagインターフェイスを実装している。
        通常これにはバリデーションのエラーが渡される。エラー発生時のリダイレクトに
        対しwithErrorsメソッドを付けると、MessageBagがセッション経由でビューに
        渡る。セッションに保存されていない場合でも、メッセージを含まないMessageBagが
        生成され、$errorsにセットされる。
      --}}
      @if ($errors->has('email'))
      <div class="errors"><p>{{ $errors->first('email') }}</p></div>
      @endif
      <label for="email">メールアドレス</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}">
    </div>

    {{-- passwordフィールド --}}
    <div class="pure-control-group">
      @if ($errors->has('password'))
      <div class="errors"><p>{{ $errors->first('password') }}</p></div>
      @endif
      <label for="password">パスワード</label>
      {{--
        セキュリティのプラクティスに従い、
        パスワードの入力値は表示しない = レスポンスへ含めない
      --}}
      <input id="password" type="password" name="password">
    </div>

    <div class="pure-controls">

      {{-- remember me（継続ログイン）の有効無効指定チェックボックス --}}
      <label for="remember" class="pure-checkbox">
        <input id="remember" type="checkbox" name="remember"
          {{-- remember入力項目が存在しているならば、チェックされている --}}
          {!! old('remember') ? 'checked="checked"' : '' !!} > 継続ログイン
      </label>

      {{-- ログインボタン --}}
      <button type="submit" class="pure-button">ログイン</button>

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
      <a class="pure-button" href="{!! url('/password/email') !!}">
        パスワードリセット
      </a>
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
  </fieldset>
</form>
@endsection
