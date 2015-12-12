{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
権限がありません
@endsection

@section('breadcrumb')
<li class="active">401</li>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <h3>権限がありません。(401)</h3>
    {{--
      abortヘルパーでコードと共にメッセージが渡された場合は、それを優先し表示する。
      メッセージが指定されていない場合はデフォルトのメッセージを表示する。
    --}}
    <p>{{ $exception->getMessage() ? : 'このページにアクセスするには認証と資格が必要です。' }}</p>
  </div>
</div>
@endsection
