@extends('layouts.login')

@section('content')


<form action="/result" method="post">
  @csrf
  <!-- ↑セキュリティ対策　Laravelのbladeファイルにフォームタグを入れるときにはこの記述が必要　419が出る -->
  <!-- 404はルーティングがおかしい　ページ遷移が原因かも -->
  <input type="text" name="keyword">
  <button type="submit"><img src="images/search.png" alt="検索"></button>
</form>

@if(isset($keyword))
<h1 class="search">検索ワード:{{$keyword}}</h1>
@endif

@foreach($users as $user)

<img src="images/{{$user->images}}" alt="アイコン">
{{$user->username}}

@if($user->follower == Auth::id())
<form action="/follow/delete" method="POST">
  @csrf
  <input type="hidden" value="{{$user->id}}" name="id">
  <button type="submit">フォローを外す</button>
</form>

@elseif($user->id == Auth::id())
<h1>自分なのでボタンを表示しない</h1>

@else
<form action="/follow/create" method="POST">
  @csrf
  <input type="hidden" value="{{$user->id}}" name="id">
  <button type="submit">フォローする</button>
</form>


@endif

@endforeach

@endsection
