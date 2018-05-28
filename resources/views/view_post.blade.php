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
					<div class="comment">
						<div class="content">{!! $comment->description !!}</div>
						<form action="{{ action('CommentsController@update', [$comment->id]) }}" method="POST" class="d-none form_edit">
							<div class="form-group">
								<textarea class="form-control fr-view comment_form_edit" name="description" rows="9" required>{!! $comment->description !!}</textarea>
								<input type="hidden" name="postId" value="{{ $post->id }}">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button>
								<button class="btn btn-danger cancel" title="Cancel"><i class="fa fa-times"></i></button>
							</div>
							{{ csrf_field() }}
						</form>
					</div>
					@if (Auth::check() && $comment->user_id == Auth::id())
						<div class="actions">
							<button class="btn btn-info edit_comment" title="Edit comment"><i class="fa fa-edit"></i></button>
							<a href="{{ action('CommentsController@delete', [$comment->id]) }}" class="btn btn-danger" id="delete_comment" onclick="return confirm('Are you sure you want to delete this comment? This action can\'t be undone.');" title="Delete comment"><i class="fa fa-trash"></i></a>
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
						<textarea class="form-control" name="description" id="comment" rows="9" required></textarea>
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
  	$('textarea').froalaEditor();

  	$('.edit_comment').click(function() {
  		$(this).parent().siblings('.comment').children('.content').hide('1500');
  		$(this).parent().siblings('.comment').children('.form_edit').removeClass('d-none');
  		$(this).hide('1500');
  		$(this).siblings('#delete_comment').hide('1500');
  		$('.add_comment').hide('1500');
  	});

  	$('.cancel').click(function() {
  		$(this).parentsUntil('.content').hide('1500');
  	});
  });
</script>
@endsection