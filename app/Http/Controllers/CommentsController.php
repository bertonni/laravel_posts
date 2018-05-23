<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;	
use App\Post;
use App\Category;
use App\Comment;

class CommentsController extends Controller
{
	public function edit(Comment $comment, Post $post)
	{
		// $user = Auth::user();
		// $post = Post::find($post->id);
		// $comment = Comment::find($comment->id);
		// $edit = true;
		// return redirect(action('PostsController@viewPost', [ $comment->post_id]))->with('user', 'post', 'comment', 'edit');
		// return view('view_post', compact('user', 'post', 'comment', 'edit'));
	}

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
