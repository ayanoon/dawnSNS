<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="images/arrow.png" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>

<body>
    <header>
        <nav class="g-navi">
            <div class="nav-wrapper">
                <ul>
                    <li class="nav-item"><a href="/top">ホーム</a></li>
                    <li class="nav-item"><a href="/profile">プロフィール</a></li>
                    <li class="nav-item"><a href="/logout">ログアウト</a></li>
                </ul>
            </div>
        </nav>

        <nav class="g-navi-sp">
            <div id="head">
                <h1><a href="/top"><img src="{{asset('images/main_logo.png')}}" alt="DAWNロゴ"></a></h1>


                <div id="">
                    <p>{{ $user = Auth::user()->username }}さん<img src="{{ asset('images/' . Auth::user()->images) }}" alt="アイコン"></p>
                </div>
                <div class="menu-trigger">
                    <span></span>
                    <span></span>
                </div>
        </nav>
    </header>


    <div id="row">
        <div id="container">
            @yield('content')
        </div>
        <div id="side-bar">
            <div id="confirm">
                <p>{{ $user = Auth::user()->username }}さんの</p>
                <div>
                    <p>フォロー数</p>
                    <p>{{ $follow = DB::table('follows')->whereIn('follow', Auth::user('id'))->count() }}名</p>
                </div>
                <p class="btn"><a href="/followlist">フォローリスト</a></p>
                <div>
                    <p>フォロワー数</p>
                    <p>{{ $follower = DB::table('follows')->whereIn('follower', Auth::user('id'))->count() }}名</p>
                </div>
                <p class="btn"><a href="/followerlist">フォロワーリスト</a></p>
            </div>
            <p class="btn"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
</body>

</html>
