<?php

namespace MyBlog\Http\Controllers;

use Illuminate\Http\Request;
use Auth;	
use MyBlog\Post;
use MyBlog\Category;
use MyBlog\Comment;

class CommentsController extends Controller
{

	public function delete(Request $request, Comment $comment)
	{
		$comment->delete();
		return redirect(action('PostsController@viewPost', [$comment->post_id])); 
	}

	public function update(Request $request, Comment $comment)
	{
		$postId = $request->post_id;
		$comment->description = $request->description;
		$comment->save();

		return redirect(action('PostsController@viewPost', [$request->postId])); 
	}

	public function create(Request $request) {
		$comment = new Comment();
		$comment->description = $request->description;
		$comment->user_id = Auth::id();
		$comment->post_id = $request->postId;
		$comment->save();

		return redirect(action('PostsController@viewPost', [$request->postId])); 
	}
}
