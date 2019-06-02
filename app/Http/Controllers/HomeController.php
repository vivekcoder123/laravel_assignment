<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $posts=Post::orderBy('id','desc')->get();
        return view('copy-homepage',compact('posts'));
        
    }

    public function admin(){

        $users_count=User::all()->count();
        $posts_count=Post::all()->count();

        return view('admin.index',compact('users_count','posts_count'));
    }
}