@extends('layouts.login')

@section('content')

<img src="{{ asset('/images/' . $detail[0]->images) }}" alt="アイコン">

<h1>Name</h1>
{{ $detail[0]->username }}

<h1>Bio</h1>
{{ $detail[0]->bio }}

<!-- フォローするorフォロー外すボタン -->

@if($detail[0]->follower == Auth::id())
<form action="/follow/delete" method="POST">
  @csrf
  <input type="hidden" value="{{$detail[0]->id}}" name="id">
  <button type="submit">フォローを外す</button>
</form>

@else
<form action="/follow/create" method="POST">
  @csrf
  <input type="hidden" value="{{$detail->id}}" name="id">
  <button type="submit">フォローする</button>
</form>

@endif





@foreach($detail as $user)
@if(isset($user->posts))

<img src="{{ asset('/images/' . $user->images) }}" alt="アイコン">
<div>{{ $user->username}}</div>
<div>{{ $user->posts }}</div>
<div>{{ $user->updated_at }}</div>

@endif
@endforeach


@endsection
