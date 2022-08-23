@extends('layouts.login')

@section('content')

<div class="wrapper">

    <div class="form-wrapper">
        <img class="user-image" src="{{ asset('/images/' . Auth::user()->images) }}" alt="アイコン">
        {!! Form::open(['url' => 'top/create']) !!}
        <!-- <div class="form-group"> -->
        {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '何をつぶやこうか…?']) !!}
        <!-- </div> -->
        <input type="image" class="post-btn" src="{{ asset('images/post.png') }}" alt="送信">
    </div>



    {!! Form::close() !!}

    <div class="post-wrapper">
        @foreach($posts_list as $list)
        <div class="post-delimit">

            <img class="user-image" src="images/{{ $list->images}}" alt="アイコン">
            <div class="post-username">{{ $list->username}}</div>
            <div class="post-time">{{ $list->created_at }}</div>
            <div class="post-post">{{ $list->posts }}</div>


            @if ($list->user_id == Auth::id())
            <div>
                <a class="btn-edit" href="/top/{{$list->id}}/update-form"><img src="{{asset('images/edit.png')}}" alt="編集"></a>
            </div>
            <div>
                <a class="btn-trash" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')" href="/top/{{$list->id}}/delete"><img src="{{ asset('images/trash.png') }}" alt="削除"></a>
            </div>
            @endif

        </div>
        @endforeach
    </div>
</div>



@endsection
