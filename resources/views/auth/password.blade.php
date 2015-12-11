{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@stopまでの間が各セクションの内容となる --}}

@section('title')
リセットメール送信:UserモデルCRUDサンプル
@stop

@section('breadcrumb')
<li><a href="{!! url('auth/login') !!}">ログイン</a></li>
<li class="active">リセットメール送信</li>
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

      {{-- リセットボタン --}}
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">リセットメール送信</button>
        </div>
      </div>

      {{-- CSRFを防ぐためのトークンを隠しフィールドに埋め込むコードの生成 --}}
      {!! csrf_field() !!}
    </form>
  </div>
</div>
@endsection
