{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@stopまでの間が各セクションの内容となる --}}

@section('title')
ユーザー登録:UserモデルCRUDサンプル
@stop

@section('page')
ユーザー登録
@stop

@section('content')
<div class="row">
  <form class="col s12" method="POST">

    {{-- nameフィールド --}}
    <div class="row">
      <div class="col s12 input-field">
        <input id="name" type="text" name="name" value="{{ old('name') }}" length="255"
               class="{{ $errors->has('name') ? 'error' : '' }}">
        <label for="name">ユーザー名</label>
        @if ($errors->has('name'))
        <p class="error-msg">{{ $errors->first('name') }}</p>
        @else
        <p class="help-msg">登録するユーザー名を指定してください。</p>
        @endif
      </div>
    </div>

    {{-- emailフィールド --}}
    <div class="row">
      <div class="col s12 input-field">
        <input id="email" type="email" name="email" value="{{ old('email') }}" length="255"
               class="{{ $errors->has('email') ? 'error' : '' }}">
        <label for="email">メールアドレス</label>
        @if ($errors->has('email'))
        <p class="error-msg">{{ $errors->first('email') }}</p>
        @else
        <p class="help-msg">登録するメールアドレスを指定してください。</p>
        @endif
      </div>
    </div>

    {{-- passwordフィールド --}}
    <div class="row">
      <div class="col s12 input-field">
        <input id="password" type="password" name="password"
               class="{{ $errors->has('password') ? 'error' : '' }}">
        <label for="password">パスワード</label>
        @if ($errors->has('password'))
        <p class="error-msg">{{ $errors->first('password') }}</p>
        @else
        <p class="help-msg">登録するパスワードを指定してください。</p>
        @endif
      </div>
    </div>

    {{-- password_confirmationフィールド --}}
    <div class="row">
      <div class="col s12 input-field">
        <input id="password_confirmation" type="password" name="password_confirmation"
               class="{{ $errors->has('password_confirmation') ? 'error' : '' }}">
        <label for="password_confirmation">パスワード確認</label>
        @if ($errors->has('password_confirmation'))
        <p class="error-msg">{{ $errors->first('password_confirmation') }}</p>
        @else
        <p class="help-msg">確認のためパスワードをもう一度指定してください。</p>
        @endif
      </div>
    </div>

    {{-- 登録ボタン --}}
    <div class="row">
      <div class="col s12 input-field">
        <button class="btn waves-effect" type="submit" name="action">
          ユーザー登録 <i class="material-icons right">send</i>
        </button>
      </div>
    </div>

    {{-- CSRFを防ぐためのトークンを隠しフィールドに埋め込むコードの生成 --}}
    {!! csrf_field() !!}
  </form>
</div>
@stop
