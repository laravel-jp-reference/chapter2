{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
ページが見つかりません
@endsection

@section('page')
404
@endsection

@section('content')
<div class="row">
  <div class="col s12">
    <h4>ページが見つかりません</h4>
    {{--
      abortヘルパーでコードと共にメッセージが渡された場合は、それを優先し表示する。
      メッセージが指定されていない場合はデフォルトのメッセージを表示する。
     --}}
    <p>{{ $exception->getMessage() ? : '指定されたURLに該当するページが見つかりません。' }}</p>
  </div>
</div>
@endsection
