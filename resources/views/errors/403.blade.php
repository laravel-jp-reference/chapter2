{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
アクセスが拒否されました
@endsection

@section('content')
<div class="pure-u-1">
  <h1>アクセスが拒否されました。(403)</h1>
  {{--
    abortヘルパーでコードと共にメッセージが渡された場合は、それを優先し表示する。
    メッセージが指定されていない場合はデフォルトのメッセージを表示する。
  --}}
  <p>{{ $exception->getMessage() ? : 'アクセスできません。' }}</p>
</div>
<div class="pure-u-1">
  {{-- トップページへ戻る --}}
  <a class="pure-button" href="{!! url('/') !!}">トップページへ戻る</a>
</div>
@endsection
