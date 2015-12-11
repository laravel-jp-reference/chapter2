{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@stopまでの間が各セクションの内容となる --}}

@section('title')
ユーザー情報編集:UserモデルCRUDサンプル
@stop

@section('breadcrumb')
<li><a href="{!! url('user') !!}">ユーザー一覧表示</a></li>
<li class="active">ユーザー情報編集</li>
@stop

@section('content')
<div class="row">
  <div class="col-sm-12">
    <form class="form-horizontal" method="POST" >

      {{-- nameフィールド --}}
      <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
        <label class="col-sm-2 control-label" for="name">ユーザー名</label>
        <div class="col-sm-10">
          <input id="name" class="form-control" type="name" name="name" value="{{ old('name', $user->name) }}">
        </div>
        @if ($errors->has('name'))
        <div class="col-sm-10 col-sm-offset-2"
             <span class="help-block">{{ $errors->first('name') }}</span>
        </div>
        @endif
      </div>


      {{-- emailフィールド --}}
      <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
        <label class="col-sm-2 control-label" for="email">メールアドレス</label>
        <div class="col-sm-10">
          <input id="email" class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}">
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

      {{-- 変更ボタン --}}
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">変更</button>
        </div>
      </div>

      {{-- CSRFを防ぐためのトークンを隠しフィールドに埋め込むコードの生成 --}}
      {!! csrf_field() !!}
    </form>
  </div>
</div>
@stop
