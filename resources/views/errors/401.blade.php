{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@endsectionまでの間が各セクションの内容となる --}}

@section('title')
権限がありません
@endsection

@section('content')
<div class="pure-u-1">
  <h1>権限がありません。(401)</h1>
  <p>このページにアクセスする権限がありません。</p>
</div>
<div class="pure-u-1">
  {{-- トップページへ戻る --}}
  <a class="pure-button" href="{!! url('/') !!}">トップページへ戻る</a>
</div>
@endsection
