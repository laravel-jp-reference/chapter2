{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@stopまでの間が各セクションの内容となる --}}

@section('title')
サービスが利用できません
@stop

@section('breadcrumb')
<li class="active">503</li>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <h3>サービスが利用できません。(503)</h3>
    <p>一時的にアクセスが増大したか、サービスの運営に支障が生じています。</p>
    <p>もうしばらくお待ちになり、後ほど再度お試しください。</p>
  </div>
</div>
@stop
