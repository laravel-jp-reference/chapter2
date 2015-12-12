{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
ユーザー専用:UserモデルCRUDサンプル
@endsection

@section('breadcrumb')
<li class="active">ユーザー専用ページ</li>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <p>ようこそ、{{ Auth::user()->name }}さん。</p>
    <p>ここは、認証（ログイン）済みの  ユーザーさんしかご覧いただけないページです。</p>
  </div>
</div>
@endsection
