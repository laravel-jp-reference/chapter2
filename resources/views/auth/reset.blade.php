{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
パスワードリセット:UserモデルCRUDサンプル
@endsection

@section('breadcrumb')
<li><a href="{!! url('auth/login') !!}">ログイン</a></li>
<li class="active">パスワードリセット</li>
@endsection

@section('content')
<div class="row">
  <div class="col-sm-12">
    {{--
      このフォームの表示URIが/password/reset/トークン に対して、その処理は
      POSTメソッドの/password/resetになる。同一ではないためactionを指定する。
    --}}
    <form class="form-horizontal" method="POST"
          action="{!! url('/password/reset') !!}">

      {{-- emailフィールド --}}
      <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
        <label class="col-sm-2 control-label" for="email">メールアドレス</label>
        <div class="col-sm-10">
          <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}">
        </div>
        @if ($errors->has('email'))
        <div class="col-sm-10 col-sm-offset-2"
             <span class="help-block">{{ $errors->first('email') }}</span>
        </div>
        @endif
      </div>

      {{-- passwordフィールド --}}
      <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
        <label class="col-sm-2 control-label" for="password">パスワード</label>
        <div class="col-sm-10">
          <input id="password" class="form-control" type="password" name="password">
        </div>
        @if ($errors->has('password'))
        <div class="col-sm-10 col-sm-offset-2"
             <span class="help-block">{{ $errors->first('password') }}</span>
        </div>
        @endif
      </div>

      {{-- password_confirmationフィールド --}}
      <div class="form-group {!! $errors->has('password_confirmation') ? 'has-error' : '' !!}">
        <label class="col-sm-2 control-label" for="password_confirmation">パスワード確認</label>
        <div class="col-sm-10">
          <input id="password_confirmation" class="form-control" type="password" name="password_confirmation">
        </div>
        @if ($errors->has('password_confirmation'))
        <div class="col-sm-10 col-sm-offset-2"
             <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
        </div>
        @endif
      </div>

      {{-- リセットボタン --}}
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">パスワードリセット</button>
        </div>
      </div>

      {{--
        メールから送られてきたパスワードリセットトークン。
        これによりメールを受け取った本人のみリセット可能で、
        第三者によりリセットされないようにする。
      --}}
      <input type="hidden" name="token" value="{{ $token }}">

      {{-- CSRFを防ぐためのトークンを隠しフィールドに埋め込むコードの生成 --}}
      {!! csrf_field() !!}
    </form>
  </div>
</div>
@endsection
