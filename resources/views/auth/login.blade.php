{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@endsectionまでの間が各セクションの内容となる --}}

@section('title')
ログイン:UserモデルCRUDサンプル
@endsection

@section('content')
<h1>ログイン</h1>

{{-- actionのURLをコントローラーとアクションを指定し生成 --}}
<form class="pure-form pure-form-aligned" method="POST">
  <fieldset>

    {{-- nameフィールド --}}
    <div class="pure-control-group">
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
      <input id="password" type="password" name="password">
    </div>

    <div class="pure-controls">

      {{-- remembe me（継続ログイン）の有効無効指定チェックボックス --}}
      <label for="remember" class="pure-checkbox">
        <input id="remember" type="checkbox" name="remember"> 継続ログイン
      </label>

      {{-- ログインボタン --}}
      <button type="submit" class="pure-button">ログイン</button>

      {{-- パスワードリセットボタン --}}
      {{--
               たとえばルートURLにサブディレクトリーが含まれる場合を
               考慮し、URIをリンク先に指定する場合でもurlヘルパーで
               フルURLを生成する。
            --}}
      <a class="pure-button" href="{!! url('/password/email') !!}">
        パスワードリセット
      </a>
    </div>

    {{-- CSRFを防ぐためのトークンを隠しフィールドに埋め込むコードの生成 --}}
    {!! csrf_field() !!}
  </fieldset>
</form>
@endsection
