{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@stopまでの間が各セクションの内容となる --}}

@section('title')
ログイン:UserモデルCRUDサンプル
@stop

@section('breadcrumb')
<li class="active">ログイン</li>
@stop

@section('content')
<div class="row">
  <div class="col-sm-12">
    <form class="form-horizontal" method="POST">

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

      {{-- remembe me（継続ログイン）の有効無効指定チェックボックス --}}
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <div class="checkbox">
            <label>
              <input id="remember" type="checkbox" name="remember"> 継続ログイン
            </label>
          </div>
        </div>
      </div>

      {{-- ログインボタン --}}
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">ログイン</button>
        </div>
      </div>

      {{-- パスワードリセットボタン --}}
      {{--
        たとえばルートURLにサブディレクトリーが含まれる場合を
        考慮し、URIをリンク先に指定する場合でもurlヘルパーで
        フルURLを生成する。
     --}}
      <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
          <a class="btn btn-primary" href="{!! url('/password/email') !!}">
            パスワードを忘れました
          </a>
        </div>
      </div>

      {{-- CSRFを防ぐためのトークンを隠しフィールドに埋め込むコードの生成 --}}
      {!! csrf_field() !!}
    </form>
  </div>
</div>
@endsection
