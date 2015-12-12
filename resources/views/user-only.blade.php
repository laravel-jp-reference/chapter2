{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
ユーザー専用:UserモデルCRUDサンプル
@endsection

@section('content')
<h1>ユーザー専用ページ</h1>

<div class="pure-u-1">
  <p>ようこそ、{{ Auth::user()->name }}さん。</p>
  <p>ここは、認証（ログイン）済みの  ユーザーさんしかご覧いただけないページです。</p>
</div>
<div class="pure-u-1">
  {{-- ログオフボタン --}}
  <a class="pure-button" href="{!! url('/auth/logout') !!}">ログオフ</a>
</div>
@endsection
