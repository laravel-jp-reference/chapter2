{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@stopまでの間が各セクションの内容となる --}}

@section('title')
権限がありません
@stop

@section('page')
401
@stop

@section('content')
<div class="row">
  <div class="col s12">
    <h4>権限がありません</h4>
    <p>このページにアクセスする権限がありません。</p>
  </div>
</div>
@stop
