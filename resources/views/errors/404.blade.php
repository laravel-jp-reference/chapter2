{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@stopまでの間が各セクションの内容となる --}}

@section('title')
ページが見つかりません
@stop

@section('page')
404
@stop

@section('content')
<div class="row">
  <div class="col s12">
    <h4>ページが見つかりません</h4>
    <p>指定されたURLに該当するURLが見つかりません。</p>
  </div>
</div>
@stop
