@extends('layouts.login')

@section('content')

<h1>Follow list</h1>

@foreach($users as $user)
<a href="どこに飛ばせばいいんだろう？"></a><img src="images/{{$user->images}}" alt="アイコン"></a>
@endforeach

@endsection
