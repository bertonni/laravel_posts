<?php

namespace MyBlog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;	
use MyBlog\Post;
use MyBlog\Category;
use MyBlog\Comment;
use MyBlog\User;

class UsersController extends Controller
{

	public function update(Request $request)
	{
		$user = User::find($request->id);
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->about_me = $request->about_me;
		$user->email = $request->email;
		$user->save();

		return view('profile', compact('user'));
	}

	public function profile($userId)
	{
		if ($userId !== null) {
			$user = User::find($userId);
		} else {
			$user = Auth::user();
		}
		return view('profile', compact('user'));
	}

	public function search(Request $request)
	{
		$users = User::where('first_name', 'like', '%' . $request->text . '%')
		->where('first_name', 'like', '%' . $request->text . '%')
		->orWhere('last_name', 'like', '%' . $request->text . '%')
		->orderBy('first_name')
		->paginate(7);

		$count = sizeof($users);
		return view('users', compact('users', 'count'));
	}
}
