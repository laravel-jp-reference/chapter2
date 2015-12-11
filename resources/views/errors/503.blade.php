{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@stopまでの間が各セクションの内容となる --}}

@section('title')
サービスが利用できません
@stop

@section('page')
503
@stop

@section('content')
<div class="row">
  <div class="col s12">
    <h4>サービスが利用できません</h4>
    <p>一時的にアクセスが増大したか、サービスの運営に支障が生じています。</p>
    <p>もうしばらくお待ちになり、後ほど再度お試しください。</p>
  </div>
</div>
@stop
