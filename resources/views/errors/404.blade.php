{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@endsectionまでの間が各セクションの内容となる --}}

@section('title')
ページが見つかりません
@endsection

@section('content')
<div class="pure-u-1">
  <h1>ページが見つかりません。(404)</h1>
  <p>指定されたURLに該当するURLが見つかりません。</p>
</div>
<div class="pure-u-1">
  {{-- トップページへ戻る --}}
  <a class="pure-button" href="{!! url('/') !!}">トップページへ戻る</a>
</div>
@endsection
