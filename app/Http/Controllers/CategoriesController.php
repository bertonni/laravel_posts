<?php

namespace MyBlog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;	
use MyBlog\Post;
use MyBlog\Category;

class CategoriesController extends Controller
{
	public function index()
	{
		$user = Auth::user();
		$posts = DB::table('posts')
		->latest()
		->take(10)
		->get();

		return view('index_post',compact('user', 'posts'));
	}

	public function add()
	{
		$user = Auth::user();
		return view('add_category', compact('user'));
	}

	public function create(Request $request)
	{

		$validatedData = $request->validate([
			'title' => 'required|unique:categories|max:255',
		]);
		
		$category = new Category();
		$category->title = $request->title;
		$category->save();
		return redirect('/'); 
	}
}
