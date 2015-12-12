{{-- 親ビューの指定 --}}
@extends('layout')

{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
ユーザー一覧表示:UserモデルCRUDサンプル
@endsection

@section('page')
ユーザー一覧表示
@endsection

@section('content')
{{-- ユーザーレコード一覧表示 --}}
<div class="row">
  <div class="col s12">
    <table class="striped responsive-table">
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
            <a class="pure-button" href="{!! url('/user/edit', [$user->id]) !!}"><i class="material-icons">play_circle_filled</i></a>
          </td>
          <td>
            <a class="pure-button" href="{!! url('/user/remove', [$user->id]) !!}"><i class="material-icons">delete</i></a>
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

<div class="row">
  <div class="col s12">
    {{--
      MaterializedとLaravelがデフォルトで生成するBootstrapのペジネーションは
      互換性があるため流用できる。
    --}}
    {!! $users->render() !!}
  </div>
</div>
@endsection
