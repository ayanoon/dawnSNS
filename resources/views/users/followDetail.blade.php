@extends('layouts.login')

@section('content')

<h1>Follow list</h1>

@foreach($follows as $follow)
<a href=""><img src="images/{{$follow->images}}" alt="アイコン"></a>
@endforeach

<br>

@foreach($users as $user)
@if(isset($user->posts))

<img src="images/{{ $user->images}}" alt="アイコン">
<div>{{ $user->username}}</div>
<div>{{ $user->posts }}</div>
<div>{{ $user->created_at }}</div>

@endif
@endforeach



@endsection
