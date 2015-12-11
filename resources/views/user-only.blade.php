{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@stopまでの間が各セクションの内容となる --}}

@section('title')
ユーザー専用:UserモデルCRUDサンプル
@stop

@section('breadcrumb')
<li class="active">ユーザー専用ページ</li>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <p>ようこそ、{{ Auth::user()->name }}さん。</p>
    <p>ここは、認証（ログイン）済みの  ユーザーさんしかご覧いただけないページです。</p>
  </div>
</div>
@endsection
