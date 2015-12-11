{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@stopまでの間が各セクションの内容となる --}}

@section('title')
トップページ:UserモデルCRUDサンプル
@stop

@section('page')
トップページ
@stop

@section('content')
<div class="row">
  <div class="col s12">
    @if(Auth::check())
    {{-- 認証（ログイン）済み --}}
    <div class="pure-u-1">
      ようこそ、{{ Auth::user()->name }}さん。
    </div>
    @else
    {{-- 未認証（ログオフ状態） --}}
    <div class="pure-u-1">
      ようこそ、ゲストさん。
    </div>
  </div>
</div>
@endif
@endsection
