{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
内部エラーが発生しました
@endsection

@section('page')
500
@endsection

@section('content')
<div class="row">
  <div class="col s12">
    <h4>内部エラーが発生しました。(500)</h4>
    {{--
      abortヘルパーでコードと共にメッセージが渡された場合は、それを優先し表示する。
      メッセージが指定されていない場合はデフォルトのメッセージを表示する。
    --}}
    @if ($exception->getMessage())
    <p>{{ $exception->getMessage() }}</p>
    @else
    <p>内部的な障害のため、ただ今アクセスできません。</p>
    <p>対策が完了するまで、しばらくお待ちください。</p>
    @endif
  </div>
</div>
@endsection
