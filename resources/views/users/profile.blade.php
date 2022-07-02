@extends('layouts.login')

@section('content')


<img src="images/{{Auth::user()->images}}" alt="アイコン">

{!! Form::open(['files'=>true]) !!}

{{ Form::label('UserName')}}<br>
{!! Form::input('text', 'userName', $user = Auth::user()->username, ['required']) !!}<br>
@if($errors->has('userName'))
{{$errors->first('userName')}}
@endif

{{ Form::label('MailAddress')}}<br>
{!! Form::input('text', 'mail', $user = Auth::user()->mail, ['required']) !!}<br>
@if($errors->has('mail'))
{{$errors->first('mail')}}
@endif

{{ Form::label('Password')}}<br>
{!! Form::input('password', 'password', $user = Auth::user()->password,['readonly']) !!}<br>
@if($errors->has('password'))
{{$errors->first('password')}}
@endif

{{ Form::label('new Password')}}<br>
{!! Form::input('password', 'newPassword') !!}<br>
@if($errors->has('newPassword'))
{{$errors->first('newPassword')}}
@endif

{{ Form::label('Bio')}}<br>
{!! Form::input('text', 'bio', $user = Auth::user()->bio) !!}<br>
@if($errors->has('bio'))
{{$errors->first('bio')}}
@endif

{{ Form::label('Icon Image')}}<br>
{!! Form::file('icon',['class'=>'input']) !!}<br>
@if($errors->has('icon'))
{{$errors->first('icon')}}
@endif

<button type="submit" class="btn btn-success pull-right">更新</button>

{!! Form::close() !!}

@endsection
