{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
ユーザー登録:UserモデルCRUDサンプル
@endsection

@section('content')
<h1>ユーザー登録</h1>
<form class="pure-form pure-form-aligned" method="POST">
  <fieldset>

    {{-- nameフィールド --}}
    <div class="pure-control-group">
      @if ($errors->has('name'))
      <div class="errors"><p>{{ $errors->first('name') }}</p></div>
      @endif
      <label for="name">ユーザー名</label>
      <input id="name" type="text" name="name" value="{{ old('name') }}">
    </div>

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
      <button type="submit" class="pure-button">登録</button>
    </div>

    {{-- CSRFを防ぐためのトークンを隠しフィールドに埋め込むコードの生成 --}}
    {!! csrf_field() !!}
  </fieldset>
</form>
@endsection
