{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
トップページ:UserモデルCRUDサンプル
@endsection

@section('content')
<h1>トップページ</h1>

@if(Auth::check())
{{-- 認証済み時（ログイン状態） --}}
<div class="pure-u-1">
  ようこそ、{{ Auth::user()->name }}さん。
</div>

<div class="pure-u-1">
  {{-- ログオフボタン --}}
  <a class="pure-button" href="{!! url('/auth/logout') !!}">ログオフ</a>
</div>
@else
{{-- 未認証時（ログオフ状態） --}}
<div class="pure-u-1">
  ようこそ、ゲストさん。
</div>

<div class="pure-u-1">
  {{-- ログインボタン --}}
  <a class="pure-button" href="{!! url('/auth/login') !!}">ログイン</a>

  {{-- ユーザー登録ボタン --}}
  <a class="pure-button" href="{!! url('/auth/register') !!}">ユーザー登録</a>
</div>
@endif
@endsection
