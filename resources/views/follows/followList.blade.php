@extends('layouts.login')

@section('content')

@foreach($users as $user)

<img src="images/{{$user->images}}" alt="アイコン">

@endforeach

@endsection
