<?php

namespace MyBlog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;
use Auth;
use Session;

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
        ->take(12)
        ->get();

        $categories = DB::table('categories')
        ->get();

        $users = DB::table('users')
        ->get();

        return view('index',compact('user', 'posts', 'categories', 'users'));
    }

    /**
     * Change session locale
     * @param  Request $request
     * @return Response
     */
    public function changeLocale(Request $request)
    {
        $this->validate($request, ['locale' => 'required|in:pt_br,en']);
        Session::put('locale', $request->locale);
        App::setLocale($request->locale);
        
        return redirect()->back();
    }
}
