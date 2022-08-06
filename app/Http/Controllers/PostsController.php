<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Auth;
use DB;

class PostsController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        $follow_id = DB::table('follows')
            ->where('follower', Auth::id()) //followsテーブルのfollowerカラムが自分=自分がフォローしている人
            ->pluck('follow'); //情報を取得
        $posts_list = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id') //postsテーブルと、usersテーブルをJOIN。usersテーブルのIDカラムと、postsテーブルのuser_idカラムが同じところをJOINする。
            ->whereIn('users.id', $follow_id) //usersテーブルのidカラムが自分がフォローしている人か、
            ->orWhere('users.id', Auth::id()) //usersテーブルのidカラムが自分
            ->select('users.images', 'users.username', 'posts.posts', 'posts.created_at', 'posts.updated_at', 'posts.user_id', 'posts.id')
            ->orderby('posts.created_at', 'desc') //新しい順に並べる
            ->get();

        return view('posts.index', compact('auth', 'posts_list'));
    }


    public function create(Request $request)
    {
        $post = $request->input('newPost');
        \DB::table('posts')->insert([
            'posts' => $post,
            'user_id' => $request->user()->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect('/top');
    }

    public function updateForm($id)
    {
        $post = \DB::table('posts')
            ->where('id', $id)
            ->first();
        return view('posts.updateForm', ['post' => $post]);
    }
    //    引数に$id変数を配置。
    //    postsテーブルの中の$idの投稿を更新する

    public function update(Request $request)
    {
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        \DB::table('posts')
            ->where('id', $id)
            ->update(
                ['posts' => $up_post]
            );
        return redirect('/top');
    }

    public function delete($id)
    {
        DB::table('posts')
            ->where('id', $id)
            ->delete();
        return redirect('/top');
    }
}
