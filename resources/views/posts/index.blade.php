@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>
<div class="wrapper">

    {!! Form::open(['url' => 'top/create']) !!}
    <div class="form-group">
        {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '何をつぶやこうか…?']) !!}
    </div>

    <input type="image" class="button" src="images/post.png" alt="送信">

    {!! Form::close() !!}

    <div class="post-wrapper">
        @foreach($posts_list as $list)
        <div style="padding:2rem; border-top: solid 1px #E6ECF0; border-bottom: solid 1px #E6ECF0;">

            <img src="images/{{ $list->images}}" alt="アイコン">
            <div>{{ $list->username}}</div>
            <div>{{ $list->posts }}</div>
            <div>{{ $list->created_at }}</div>


            @if ($list->user_id == Auth::id())
            <div>
                <a class="btn" href="/top/{{$list->id}}/update-form"><img src="{{asset('images/edit.png')}}" alt="編集"></a>
            </div>
            <div>
                <a class="btn" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')" href="/top/{{$list->id}}/delete"><img src="{{asset('images/trash.png')}}" alt="削除"></a>
            </div>
            @endif

        </div>
        @endforeach
    </div>
</div>



@endsection
