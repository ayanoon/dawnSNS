@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>
    <div class="wrapper">
            <form action="/top" method="post">
            {{ csrf_field() }}
                <div >
                    <input type="text" name="post" placeholder="投稿文">
                    <button type="submit" >投稿</button>
                </div>

            </form>

            <div class="post-wrapper">
                @foreach($posts as $post)
                <div style="padding:2rem; border-top: solid 1px #E6ECF0; border-bottom: solid 1px #E6ECF0;">
                    <div>{{ $post->posts }}</div>
                    <div>{{ $post->updated_at }}</div>
                    <a href="index.blade.php"><img src="../../../public/images/edit.png" alt="編集"></a>
                    <a href="index.blade.php"><img src="../../../public/images/trash.png" alt="削除"></a>
                    <!-- ↑画像がうまく表示されない。。 -->
                </div>
                @endforeach
            </div>
    </div>



@endsection
