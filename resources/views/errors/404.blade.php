{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降のsectionから、endsectionまでの間が各セクションの内容となる --}}

@section('title')
ページが見つかりません
@endsection

@section('content')
<div class="pure-u-1">
  <h1>ページが見つかりません。(404)</h1>
  {{--
    abortヘルパーでコードと共にメッセージが渡された場合は、それを優先し表示する。
    メッセージが指定されていない場合はデフォルトのメッセージを表示する。
  --}}
  <p>{{ $exception->getMessage() ? : '指定されたURLに該当するページが見つかりません。' }}</p>
</div>
<div class="pure-u-1">
  {{-- トップページへ戻る --}}
  <a class="pure-button" href="{!! url('/') !!}">トップページへ戻る</a>
</div>
@endsection
