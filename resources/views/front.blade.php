{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@stopまでの間が各セクションの内容となる --}}

@section('title')
トップページ:UserモデルCRUDサンプル
@stop

@section('breadcrumb')
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    @if(Auth::check())
    {{-- 認証（ログイン）済み --}}
    ようこそ、{{ Auth::user()->name }}さん。
    @else
    {{-- 未認証（ログオフ状態） --}}
    ようこそ、ゲストさん。
    @endif
  </div>
</div>
@endsection
