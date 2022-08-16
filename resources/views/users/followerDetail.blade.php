@extends('layouts.login')

@section('content')

<h1>Name</h1>
{{ $detail[0]->username }}

<h1>Bio</h1>
{{ $detail[0]->bio }}

@foreach($detail as $user)
@if(isset($user->posts))

<img src="images/{{ $user->images}}" alt="アイコン">
<div>{{ $user->username}}</div>
<div>{{ $user->posts }}</div>
<div>{{ $user->updated_at }}</div>

@endif
@endforeach


@endsection
