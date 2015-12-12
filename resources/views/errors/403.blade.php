{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
アクセスが拒否されました
@endsection

@section('breadcrumb')
<li class="active">403</li>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <h3>アクセスが拒否されました。(403)</h3>
    {{--
      abortヘルパーでコードと共にメッセージが渡された場合は、それを優先し表示する。
      メッセージが指定されていない場合はデフォルトのメッセージを表示する。
    --}}
    <p>{{ $exception->getMessage() ? : 'アクセスできません。' }}</p>
  </div>
</div>
@endsection
