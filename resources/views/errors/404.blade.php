{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降のsectionから、endsectionまでの間が各セクションの内容となる --}}

@section('title')
ページが見つかりません
@endsection

@section('breadcrumb')
<li class="active">404</li>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <h3>ページが見つかりません。(404)</h3>
    {{--
      abortヘルパーでコードと共にメッセージが渡された場合は、それを優先し表示する。
      メッセージが指定されていない場合はデフォルトのメッセージを表示する。
    --}}
  <p>{{ $exception->getMessage() ? : '指定されたURLに該当するページが見つかりません。' }}</p>
  </div>
</div>
@endsection
