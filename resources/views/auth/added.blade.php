@extends('layouts.logout')

@section('content')

<div id="clear">
  <div class="logout-wrapper">
    <div class="title-wrapper">
      <p>{{ session('name') }}さん、</p>
      <p>ようこそ！DAWNSNSへ！</p>
    </div>
  </div>

  <div class="welcome">
    <p>ユーザー登録が完了しました。</p>
    <p>さっそく、ログインをしてみましょう。</p>
  </div>

  <p><a class="register-button" href="/login">ログイン画面へ</a></p>
</div>

@endsection
