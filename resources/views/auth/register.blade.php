@extends('layouts.logout')

@section('content')

{!! Form::open() !!}
<div class="logout-wrapper">
  <div class="title-wrapper">
    <h2 class="title">新規ユーザー登録</h2>
  </div>

  {{ Form::label('UserName') }}<br>
  {{ Form::text('username',null,['class' => 'input']) }}<br>
  @if($errors->has('username'))
  {{$errors->first('username')}}
  @endif

  {{ Form::label('MailAdress') }}<br>
  {{ Form::text('mail',null,['class' => 'input']) }}<br>
  @if($errors->has('mail'))
  {{$errors->first('mail')}}
  @endif

  {{ Form::label('Password') }}<br>
  {{ Form::text('password',null,['class' => 'input']) }}<br>
  @if($errors->has('password'))
  {{$errors->first('password')}}
  @endif

  {{ Form::label('Password Confirm') }}<br>
  {{ Form::text('password_confirmation',null,['class' => 'input']) }}<br>


  {{ Form::submit('REGISTER', ['class' => 'submit-button'])}}

  <p><a class="register-button" href="/login">ログイン画面へ戻る</a></p>

  {!! Form::close() !!}
</div>

@endsection
