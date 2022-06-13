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
    public function index(){
        $posts = Post::latest()->get();
         return view('posts.index',compact('posts'));
    }
    public function post(Request $request){
        $validator = $request->validate([
            'post' =>['required','string','max:150'],
        ]);
        Post::create([
            'user_id' =>Auth::user()->id,
            'posts' =>$request->post,
        ]);
        return back();
    }
}
