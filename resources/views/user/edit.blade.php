{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
ユーザー情報編集:UserモデルCRUDサンプル
@endsection

@section('content')
<h1>ユーザー情報編集</h1>

<form class="pure-form pure-form-aligned" method="POST" >

  {{-- nameフィールド --}}
  <div class="pure-control-group">
    @if ($errors->has('name'))
    <div class="errors"><p>{{ $errors->first('name') }}</p></div>
    @endif
    <label for="name">ユーザー名</label>
    <input id="name" type="text" name="name"
           value="{{ old('name', $user->name) }}">
  </div>

  {{-- emailフィールド --}}
  <div class="pure-control-group">
    @if ($errors->has('email'))
    <div class="errors"><p>{{ $errors->first('email') }}</p></div>
    @endif
    <label for="email">メールアドレス</label>
    <input id="email" type="email" name="email"
           value="{{ old('email', $user->email) }}">
  </div>

  {{-- passwordフィールド --}}
  <div class="pure-control-group">
    @if ($errors->has('password'))
    <div class="errors"><p>{{ $errors->first('password') }}</p></div>
    @endif
    <label for="password">パスワード</label>
    <input id="password" type="password" name="password">
  </div>

  {{-- 登録ボタン --}}
  <div class="pure-controls">
    <button type="submit" class="pure-button">変更</button>
  </div>

  {{-- CSRFを防ぐためのトークンを隠しフィールドに埋め込むコードの生成 --}}
  {!! csrf_field() !!}
</form>
@endsection
