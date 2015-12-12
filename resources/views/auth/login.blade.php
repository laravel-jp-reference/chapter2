{{-- 親ビューの指定 --}}
@extends('layout')


{{-- 以降の@sectionから、@endsectionまでの間が各セクションの内容となる --}}

@section('title')
ログイン:UserモデルCRUDサンプル
@endsection

@section('breadcrumb')
<li class="active">ログイン</li>
@endsection

@section('content')
<div class="row">
  <div class="col-sm-12">
    <form class="form-horizontal" method="POST">

      {{-- emailフィールド --}}
      <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
        <label class="col-sm-2 control-label" for="email">メールアドレス</label>
        <div class="col-sm-10">
          <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}">
        </div>
        {{--
          @ifから@endifの間で、emailフィールドに対するバリデーションエラーを表示している。

          ビューの$errors変数は必ず存在し、MessageBagインターフェイスを実装している。
          通常これにはバリデーションのエラーが渡される。エラー発生時のリダイレクトに
          対しwithErrorsメソッドを付けると、MessageBagがセッション経由でビューに
          渡る。セッションに保存されていない場合でも、メッセージを含まないMessageBagが
          生成され、$errorsにセットされる。
        --}}
        @if ($errors->has('email'))
        <div class="col-sm-10 col-sm-offset-2"
             <span class="help-block">{{ $errors->first('email') }}</span>
        </div>
        @endif
      </div>

      {{-- passwordフィールド --}}
      <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
        <label class="col-sm-2 control-label" for="password">パスワード</label>
        <div class="col-sm-10">
          {{--
            セキュリティのプラクティスに従い、
            パスワードの入力値は表示しない = レスポンスへ含めない
          --}}
          <input id="password" class="form-control" type="password" name="password">
        </div>
        @if ($errors->has('password'))
        <div class="col-sm-10 col-sm-offset-2"
             <span class="help-block">{{ $errors->first('password') }}</span>
        </div>
        @endif
      </div>

      {{-- remembe me（継続ログイン）の有効無効指定チェックボックス --}}
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <div class="checkbox">
            <label>
              <input id="remember" type="checkbox" name="remember"
              {{-- remember入力項目が存在しているならば、チェックされている --}}
              {!! old('remember') ? 'checked="checked"' : '' !!} > 継続ログイン
            </label>
          </div>
        </div>
      </div>

      {{-- ログインボタン --}}
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">ログイン</button>
        </div>
      </div>

      {{-- パスワードリセットボタン --}}
      {{--
        ルートURLにサブディレクトリーが含まれる場合を考慮し、
        URIをリンク先に指定する場合でもurlヘルパーでフルURLを生成する。

        今回は静的にURLを生成しているだけのため問題はないが、
        スラグなどで生成URLへユーザー入力を含める場合、
        URL生成系ヘルパーやクラスの使用時には、セキュリティや不具合に
        考慮して適切にフィルタリングを行う。
        たとえばシンプルな例では、ユーザーがタイトルに"/"を含め、それを
        直接スラグにすると、URL上ではセグメントの分割になり、ルート定義に
        一致しなくなる可能性が出る。
      --}}
      <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
          <a class="btn btn-primary" href="{!! url('/password/email') !!}">
            パスワードを忘れました
          </a>
        </div>
      </div>

      {{--
        CSRFを防ぐためのトークンを隠しフィールドに埋め込むコードの生成。
        トークンの値チェックは毎回セッションごとに適用される
        VerifyCsrfTokenグローバルミドルウェアで行っている。

        参照 :
          本文 : 「7-1-3 CSRF対策」(P.749)
          ドキュメント : http://readouble.com/laravel/5/1/ja/routing.html#csrf-protection
      --}}
      {!! csrf_field() !!}
    </form>
  </div>
</div>
@endsection
