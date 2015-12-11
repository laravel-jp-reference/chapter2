{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@stopまでの間が各セクションの内容となる --}}

@section('title')
ユーザー専用:UserモデルCRUDサンプル
@stop

@section('page')
ユーザー専用ページ
@stop

@section('content')
<div class="row">
  <div class="col s12">
    <p>ようこそ、{{ Auth::user()->name }}さん。</p>
    <p>ここは、認証（ログイン）済みの  ユーザーさんしかご覧いただけないページです。</p>
  </div>
</div>
@endsection
