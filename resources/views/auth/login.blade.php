{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@stopまでの間が各セクションの内容となる --}}

@section('title')
ログイン:UserモデルCRUDサンプル
@stop

@section('page')
ログイン
@stop
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
        <input id="remember" type="checkbox" name="remember">
        <label for="remember">ログインしたままにする</label>
      </div>
    </div>

    <div class="divider"></div>

    {{-- パスワードリセットボタン --}}
    {{--
               たとえばルートURLにサブディレクトリーが含まれる場合を
               考慮し、URIをリンク先に指定する場合でもurlヘルパーで
               フルURLを生成する。
            --}}

    <div class="row">
      <div class="col s12 input-field">
        <a class="btn waves-effect waves-light" href="{!! url('/password/email') !!}">
          パスワードを忘れました
        </a>
      </div>
    </div>

    {{-- CSRFを防ぐためのトークンを隠しフィールドに埋め込むコードの生成 --}}
    {!! csrf_field() !!}
  </form>
</div>
@endsection
