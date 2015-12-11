{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@stopまでの間が各セクションの内容となる --}}

@section('title')
権限がありません
@stop

@section('breadcrumb')
<li class="active">401</li>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <h3>権限がありません。(401)</h3>
    <p>このページにアクセスする権限がありません。</p>
  </div>
</div>
@stop
