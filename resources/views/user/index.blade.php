{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから@stopまでの間が各セクションの内容となる --}}

@section('title')
ユーザー一覧表示:UserモデルCRUDサンプル
@stop

@section('breadcrumb')
<li class="active">ユーザー一覧表示</li>
@stop

@section('content')
{{-- ユーザーレコード一覧表示 --}}
<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
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
              <a class="pure-button" href="{!! url('/user/edit', [$user->id]) !!}"><span class="glyphicon glyphicon-pencil"></span></a>
            </td>
            <td>
              <a class="pure-button" href="{!! url('/user/remove', [$user->id]) !!}"><span class="glyphicon glyphicon-trash"></span></a>
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
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    {{-- ペジネーションリンク --}}
    {!! $users->render() !!}
  </div>
</div>
@stop

