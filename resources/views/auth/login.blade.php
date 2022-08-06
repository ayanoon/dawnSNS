@extends('layouts.logout')

@section('content')

{!! Form::open() !!}
<div class="logout-wrapper">
   <div class="title-wrapper">
      <p class="title">DAWNSNSへようこそ</p>
   </div>
   <div class="form-wrapper">
      {{ Form::label('MailAdress')}}<br>
      {{ Form::text('mail',null,['class' => 'input']) }}<br>

      {{ Form::label('password')}}<br>
      {{ Form::password('password',['class' => 'input'])}}<br>

      {{ Form::submit('LOGIN', ['class' => 'submit-button'])}}

      <p><a class="register-button" href="/register">新規ユーザーの方はこちら</a></p>

      {!! Form::close() !!}
   </div>
</div>
@endsection
