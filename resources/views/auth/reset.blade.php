{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
パスワードリセット:UserモデルCRUDサンプル
@endsection

@section('content')
<h1>パスワードリセット</h1>
{{--
  このフォームの表示URIが/password/reset/トークン に対して、その処理は
  POSTメソッドの/password/resetになる。同一ではないため、actionを指定する。
--}}
<form class="pure-form pure-form-aligned" method="POST"
      action="{!! url('/password/reset') !!}">
  <fieldset>

    {{-- emailフィールド --}}
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

    {{-- password_confirmationフィールド --}}
    <div class="pure-control-group">
      @if ($errors->has('password_confirmation'))
      <div class="errors"><p>{{ $errors->first('password_confirmation') }}</p></div>
      @endif
      <label for="password_confirmation">パスワード確認</label>
      <input id="password_confirmation" type="password" name="password_confirmation">
    </div>

    {{-- 登録ボタン --}}
    <div class="pure-controls">
      <button type="submit" class="pure-button">パスワードリセット</button>
    </div>

    {{--
    メールから送られてきたパスワードリセットトークン。
    これによりメールを受け取った本人のみリセット可能で、
    第三者によりリセットされないようにする。
  --}}
    <input type="hidden" name="token" value="{{ $token }}">

    {{-- CSRFを防ぐためのトークンを隠しフィールドに埋め込むコードの生成 --}}
    {!! csrf_field() !!}
  </fieldset>
</form>
@endsection
