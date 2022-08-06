<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class FollowsController extends Controller
{
    //
    public function followList()
    {
        return view('follows.followList');
    }
    public function followerList()
    {
        return view('follows.followerList');
    }


    public function create(Request $request)
    { //フォームからの値を受け取るときにこれ書く

        \DB::table('follows')
            ->insert([
                'follow' => $request->input('id'),
                'follower' => Auth::id(),
                'created_at' => now(), //今の時間を入れてくれる関数
            ]);

        return back(); //フォローするボタンを押したときの画面に戻る
    }


    public function delete(Request $request)
    {
        \DB::table('follows')
            ->where([
                'follower' => Auth::id(),
                'follow' => $request->input('id'),
            ])->delete();
        return back();
    }
}
