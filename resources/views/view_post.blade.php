@extends('layouts.app')
<style>
	.post-label {
		margin: 5px 0;
		background-color: #dcdcdc;
		border: 1px dashed #000;
		padding: 12px 7px;
	}
	.actions {
		float: right;
		bottom: 20px;
		position: relative;
	}
	.add_comment {
		margin-top: 50px;
	}
	.fa-arrow-left {
		float: right;
		color: #000;
	}
	.fa-arrow-left:hover {
		float: right;
		color: #0a0;
	}
	.author {
		float: right;
		line-height: 0px;
		padding-right: 10px;
	}
</style>
@section('content')
<div class="container">
	<h1>{{ $post->title }} <a href="{{ action('HomeController@index') }}"><i class="fa fa-arrow-left"></i></a></h1>
	<h3>{{ $post->description }}</h3>
		@if (!empty($comments))
			@foreach($comments as $comment)
				<div class="col-md-12 post-label">
					<p class="comment">{{ $comment->description }}</p>
					@if (Auth::check() && $comment->user_id == Auth::id())
						<div class="actions">
							<a href="{{ action('CommentsController@edit', [$comment->id, $post->id]) }}" class="btn btn-info" title="Edit comment"><i class="fa fa-edit"></i></a>
							<a href="{{ action('CommentsController@delete', [$comment->id]) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this comment? This action can\'t be undone.');" title="Delete comment"><i class="fa fa-trash"></i></a>
						</div>
					@endif
					<div class="author">
						@foreach ($users as $user)
							@if ($user->id == $comment->user_id)
								<b>Author: </b> {{ $user->first_name }}
								@break
							@endif
						@endforeach
					</div>
				</div>
			@endforeach
			@else
			<br>
			<p>There is no comments about this topic. Be the first one to comment.</p>
		@endif
		@if (Auth::check())
			<div class="add_comment">
				<form method="POST" action="{{ action('CommentsController@create') }}">
					<div class="form-group">
						<label for="comment">Comment:</label><br>
						<textarea class="form-control summernote" name="description" id="comment" rows="6" placeholder="Type your comment here" required></textarea>
						<input type="hidden" name="postId" value="{{ $post->id }}">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Add Comment</button>
					</div>
					{{ csrf_field() }}
				</form>
			</div>
		@else
			<p>You need to be logged to add a comment.</p>
		@endif
</div>
<script>
  $(document).ready(function() {
      $('.summernote').summernote({height: 150});
  });
</script>
@endsection