{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
権限がありません
@endsection

@section('page')
401
@endsection

@section('content')
<div class="row">
  <div class="col s12">
    <h4>権限がありません</h4>
    {{--
      abortヘルパーでコードと共にメッセージが渡された場合は、それを優先し表示する。
      メッセージが指定されていない場合はデフォルトのメッセージを表示する。
    --}}
    <p>{{ $exception->getMessage() ? : 'このページにアクセスするには認証と資格が必要です。' }}</p>
  </div>
</div>
@endsection
