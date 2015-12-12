{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
リセットメール送信:UserモデルCRUDサンプル
@endsection

@section('page')
パスワードリセットメール送信
@endsection

@section('content')
<div class="row">
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

    {{-- リセットボタン --}}
    <div class="row">
      <div class="col s12 input-field">
        <button class="btn waves-effect" type="submit" name="action">
          リセットメール送信 <i class="material-icons right">send</i>
        </button>
      </div>
    </div>


    {{-- CSRFを防ぐためのトークンを隠しフィールドに埋め込むコードの生成 --}}
    {!! csrf_field() !!}
  </form>
</div>
@endsection
