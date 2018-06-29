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

	public function upvote(Comment $comment)
	{
		$comm = Comment::find($comment->id);
		$comm->upvotes = $comment->upvotes + 1;
		$comm->save();
		return redirect(action('PostsController@viewPost', [$comm->post_id]));
	}

	public function downvote(Comment $comment)
	{
		$comm = Comment::find($comment->id);
		$comm->downvotes = $comment->downvotes + 1;
		$comm->save(); 
		return redirect(action('PostsController@viewPost', [$comm->post_id]));
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
