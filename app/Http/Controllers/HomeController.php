<?php

namespace MyBlog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $posts = DB::table('posts')
        ->latest()
        ->take(10)
        ->get();

        $categories = DB::table('categories')
        ->select('*')
        ->get();

        return view('index',compact('user', 'posts', 'categories'));
    }
    
}
