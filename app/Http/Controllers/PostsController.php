<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;	
use App\Post;
use App\Category;
use App\User;

class PostsController extends Controller
{
	public function index()
	{
		$user = Auth::user();

		return view('index_post',compact('user'));
	}

	public function add()
	{
		$user = Auth::user();

		$categories = DB::table('categories')
		->select('*')
		->get();

		return view('add_post', compact('user', 'categories'));
	}

	public function create(Request $request)
	{

		$post = new Post();
		$post->title = $request->title;
		$post->user_id = Auth::id();
		$post->category_id = $request->category;
		$post->description = $request->description;
		$post->title = $request->title;
		$post->save();

		return redirect('/'); 
	}

	public function viewPost($postId)
	{
		$id = $postId;
		$post = Post::find($id);
		
		$comments = DB::table('comments')
		->select('*')
		->where('post_id', $id)
		->get();

		$users = DB::table('users')
		->select('*')
		->get();

		return view('view_post', compact('post', 'comments', 'users'));
	}
}
