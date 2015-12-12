{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
ユーザー一覧表示:UserモデルCRUDサンプル
@endsection

@section('content')
<h1>ユーザー一覧表示</h1>

{{-- ユーザーレコード一覧表示 --}}
<table class="pure-table pure-table-horizontal">
  <thead>
    <tr>
      <th>ID</th>
      <th>氏名</th>
      <th>メールアドレス</th>
      <th>ハッシュ済みパスワード</th>
      <th>更新</th>
      <th>削除</th>
    </tr>
  </thead>
  <tbody>
    @forelse($users as $user)
    <tr>
      <td>{{ $user->id }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->password }}</td>
      <td>
        <a class="pure-button" href="{!! url('/user/edit', [$user->id]) !!}">更新</a>
      </td>
      <td>
        <a class="pure-button" href="{!! url('/user/remove', [$user->id]) !!}">削除</a>
      </td>
    </tr>
    @empty
    <tr>
      <td></td>
      <td>レコード未登録</td>
      <td></td><td></td><td></td><td></td>
    </tr>
    @endforelse
  </tbody>
</table>

{{-- ページネーションリンク --}}
{!! $users->render() !!}
@endsection
