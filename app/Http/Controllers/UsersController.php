<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;
use DB;

class UsersController extends Controller
{

    public function profile()
    {
        return view('users.profile');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function update(Request $request)
    {
        $auth = Auth::user();


        $user_mail = Auth::user()->mail;
        $validator = Validator::make($request->all(), [
            'username' => ['string', 'min:4', 'max:12',],
            'mail' => ['string', 'email', 'min:4', 'max:12', Rule::unique('users', 'mail')->ignore($user_mail, 'mail')],
            'bio' => ['string', 'max:200'],
            'icon' => ['string', 'alpha_num', 'mimes:jpeg,bmp,png,gif,svg'],

        ]);

        $data = $request->input();       //フォームの内容を文字だけ取り出す

        // ddd($request->all());undifiedとか、項目渡せていなそうなエラーだったら、これ使うとよい。


        //  [
        //     'username.required' => '名前を入力してください.',
        //     'username.min' => '名前は4文字以上で入力してください。',
        //     'username.max' => '名前は12文字以下で入力してください。',
        //     'mail.required' => 'メールアドレスを入力してください。',
        //     'mail.min' => 'メールアドレスは4文字以上で入力してください。',
        //     'mail.max' => 'メールアドレスは30文字以下で入力してください。',
        //     'mail.email' => 'メールアドレスを入力してください。',
        //     'mail.required' => 'このメールアドレスは既に登録されています。',
        //     'newPassword.required' => 'パスワードを入力してください。',
        //     'newPassword.alpha_num' => 'アルファベットまたは数字で入力してください。',
        //     'newPassword.min' => 'パスワードは4文字以上で入力してください。',
        //     'newPassword.max' => 'パスワードは12文字以上で入力してください。',
        // ])->validate();

        if ($data['newPassword']) { //パスワードに記載がある場合に

            if (request('icon')) { //アイコンに画像がある場合の処理
                $images = $request->file('icon')
                    ->getClientOriginalName(); //アップロードされたファイルの名前を取得する。getとかfirstとかじゃ取得できないのでこれを使う。
                $request->file('icon')->storeAs('images/', $images, 'icon_up');
            } else { //画像にアイコンがない場合の処理
                $images = DB::table('users')
                    ->where('id', Auth::id())
                    ->value('images'); //usersテーブルのimagesカラムを持ってくる
            }

            \DB::table('users') //パスワードに記載がある場合の処理
                ->where('id', Auth::id())
                ->update([
                    'username' => $data['userName'],
                    'mail' =>  $data['mail'],
                    'password' => bcrypt($data['newPassword']),
                    'bio' => $data['bio'],
                    'images' => $images,
                    'updated_at' => now(),
                ]);

            return redirect('/top');
        } else {
            //パスワードに記載がない場合の処理
            if (request('icon')) { //アイコンに画像がある場合の処理
                $images = $request->file('icon')
                    ->getClientOriginalName();
                $request->file('icon')->storeAs('images/', $images, 'icon_up');
            } else { //画像にアイコンがない場合の処理
                $images = DB::table('users')
                    ->where('id', Auth::id())
                    ->value('images');
            }

            \DB::table('users') //パスワードに記載がない場合の処理
                ->where('id', Auth::id())
                ->update([
                    'username' => $data['userName'],
                    'mail' =>  $data['mail'],
                    'password' => $auth->password,
                    'bio' => $data['bio'],
                    'images' => $images,
                    'updated_at' => now(),
                ]);
            return redirect('/top');
        }
    }

    public function search() //全ユーザーを表示
    {
        $users =
            DB::table('users')
            ->leftJoin('follows', 'users.id', '=', 'follows.follow')
            ->select('users.id', 'users.username', 'users.bio', 'users.images', 'follows.follow', 'follows.follower')
            ->orderby('users.id')
            ->where('users.id', '<>', Auth::id())
            ->get();

        // \DB::table('users')
        // ->leftJoin('follows', 'users.id', '=', 'follows.follow')
        // ->select('users.id', 'users.username', 'users.bio', 'users.images', 'follows.follow', 'follows.follower') //テーブルを結合した後に、その中から使いたい情報だけ持ってくる。これでIDはusersテーブルのidを使うよと指示できる。
        // ->get();

        //dd($users);

        return view('users.search', compact('users')); //カッコ内$いらない
    }

    public function result(Request $request)
    {
        $keyword = $request->input('keyword'); //inputタグで送っているからinputで受け取る
        $users = \DB::table('users')
            ->leftJoin('follows', 'users.id', '=', 'follows.follow') //joinでやると、自分がフォローしていない人などが出てこない。
            ->select('users.id', 'users.username', 'users.bio', 'users.images', 'follows.follow', 'follows.follower')
            ->where('username', 'like', "%$keyword%") //ユーザーネームカラムの値が $keywordを含むものを抽出
            ->orderby('users.id')
            ->get();

        return view('users.search', compact('users', 'keyword'));
    }

    //ここから下、自分でフォローリストフォロワーリスト書いてみた。
    //これもJOINして、usersテーブルの情報と結合して渡す必要があるけど
    //やり方がわからないので月曜日教えてもらったら完成させよう・・

    public function followlist()
    {
        $users = \DB::table('users')
            ->leftJoin('follows', 'users.id', '=', 'follows.follow')
            ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->select('users.id', 'users.username', 'users.bio', 'users.images', 'follows.follow', 'follows.follower', 'posts.posts', 'posts.created_at')
            ->orderBy('posts.created_at', 'desc')
            ->where('follower', Auth::id())
            ->get();

        //dd($users);

        $follows = \DB::table('users')
            ->leftJoin('follows', 'users.id', '=', 'follows.follow')
            ->select('users.id', 'users.images', 'follows.follow', 'follows.follower')
            ->where('follower', Auth::id())
            ->get();

        return view('users.followList', compact('users', 'follows'));
    }

    public function followerlist()
    {
        $users = \DB::table('users')
            ->leftJoin('follows', 'users.id', '=', 'follows.follower')
            ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->select('users.id', 'users.username', 'users.bio', 'users.images', 'follows.follow', 'follows.follower', 'posts.posts', 'posts.created_at')
            ->orderBy('posts.created_at', 'desc')
            ->where('follow', Auth::id())
            ->get();

        //dd($users);

        $follows = \DB::table('users')
            ->leftJoin('follows', 'users.id', '=', 'follows.follower')
            ->select('users.id', 'users.username', 'users.images', 'follows.follow', 'follows.follower')
            ->where('follow', Auth::id())
            ->get();

        //dd($follows);

        return view('users.followerList', compact('users', 'follows'));
    }

    public function followDetail($id)
    {
        $detail = \DB::table('users')
            ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->leftJoin('follows', 'users.id', '=', 'follows.follow')
            ->select('users.id', 'users.username', 'users.bio', 'users.images', 'posts.posts', 'posts.updated_at', 'follows.follower')
            ->where('users.id', $id)
            ->get();

        //dd($detail);

        return view('users.followDetail', compact('detail'));
    }

    public function followerDetail($id)
    {
        $detail = \DB::table('users')
            ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->leftJoin('follows', 'users.id', '=', 'follows.follower')
            ->select('users.id', 'users.username', 'users.bio', 'users.images', 'posts.posts', 'posts.updated_at', 'follows.follow')
            ->where('users.id', $id)
            ->get();

        //dd($detail);

        return view('users.followerDetail', compact('detail'));
    }
}
