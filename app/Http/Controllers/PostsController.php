<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class PostsController extends Controller
{
    //
    public function index(){
        return view('posts.index');
    }
}
