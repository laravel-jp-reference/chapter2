{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
リセットメール送信:UserモデルCRUDサンプル
@endsection

@section('content')
<h1>パスワードリセットメール送信</h1>
<form class="pure-form pure-form-aligned" method="POST">
  <fieldset>

    {{-- emailフィールド --}}
    <div class="pure-control-group">
      @if ($errors->has('email'))
      <div class="errors"><p>{{ $errors->first('email') }}</p></div>
      @endif
      <label for="email">メールアドレス</label>
      <input id="email" type="email" name="email"
             value="{{ old('email') }}">
    </div>
    {{-- リセットボタン --}}
    <div class="pure-controls">
      <button type="submit" class="pure-button">パスワードリセットのメール送信</button>
    </div>

    {{-- CSRFを防ぐためのトークンを隠しフィールドに埋め込むコードの生成 --}}
    {!! csrf_field() !!}
  </fieldset>
</form>
@endsection
