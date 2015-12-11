{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@stopまでの間が各セクションの内容となる --}}

@section('title')
ページが見つかりません
@stop

@section('breadcrumb')
<li class="active">404</li>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <h3>ページが見つかりません。(404)</h3>
    <p>指定されたURLに該当するURLが見つかりません。</p>
  </div>
</div>
@stop
