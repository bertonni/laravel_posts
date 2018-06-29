@extends('layouts.app')
@section('content')
<div class="container">
	@foreach($users as $user)
		@if ($post->user_id == $user->id)
			<h1>{{ $post->title }} - <a href="{{ action('UsersController@profile', [$user->id]) }}"><small>{{ $user->first_name }}</small></a> <a href="{{ action('HomeController@index') }}"><i class="fa fa-arrow-left"></i></a></h1>
			@break
		@endif
	@endforeach
	<h3>{{ $post->description }}</h3>
		@if ($count_comments > 0)
			@foreach($comments as $comment)
				<div class="col-md-12 post-label">
					<div class="votes">
						@if (Auth::check())
							<a href="{{ action('CommentsController@upvote', [$comment->id]) }}" class="up"><i class="fa fa-chevron-up fa-lg"></i></a><br>
							<span class="vote-count">{{ $comment->upvotes - $comment->downvotes }}</span><br>
							<a href="{{ action('CommentsController@downvote', [$comment->id]) }}" class="down"><i class="fa fa-chevron-down fa-lg"></i></a>
							@else
								<a href="{{ action('CommentsController@upvote', [$comment->id]) }}" class="up disabled" onclick="return false;"><i class="fa fa-chevron-up fa-lg"></i></a><br>
								<span class="vote-count">{{ $comment->upvotes - $comment->downvotes }}</span><br>
								<a href="{{ action('CommentsController@downvote', [$comment->id]) }}" class="down disabled" onclick="return false;"><i class="fa fa-chevron-down fa-lg"></i></a>
						@endif
					</div>
					<div class="comment">
						<div class="content">{!! $comment->description !!}
						</div>
						<div class="update_form">
							<form action="{{ action('CommentsController@update', [$comment->id]) }}" method="POST" class="d-none form_edit">
								<div class="form-group">
									<textarea class="form-control fr-view comment_form_edit" name="description" rows="9" required>{!! $comment->description !!}</textarea>
									<input type="hidden" name="postId" value="{{ $post->id }}">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-success" title="Save"><i class="fa fa-check fa-sm"></i></button>
									<button class="btn btn-danger cancel" title="Cancel"><i class="fa fa-times fa-sm"></i></button>
								</div>
								@csrf
							</form>
						</div>
					</div>
					<div class="actions-author">
						@if (Auth::check() && $comment->user_id == Auth::id())
								<button class="btn btn-info edit_comment" title="Edit comment"><i class="fa fa-edit fa-sm"></i></button>
								<a href="{{ action('CommentsController@delete', [$comment->id]) }}" class="btn btn-danger" id="delete_comment" onclick="return confirm('Are you sure you want to delete this comment?\nThis action can\'t be undone.');" title="Delete comment"><i class="fa fa-trash fa-sm"></i></a>
							<br><br>
						@endif
						@foreach ($users as $user)
							@if ($user->id == $comment->user_id)
								<b>@lang('messages.author') </b> <a href="{{ action('UsersController@profile', [$user->id]) }}" class="author">{{ $user->first_name }}</a>
								@break
							@endif
						@endforeach
					</div>
				</div>
			@endforeach
		@else
			<br>
			<p>@lang('messages.no_comments')</p>
		@endif
		@if (Auth::check())
			<div class="add_comment">
				<form method="POST" action="{{ action('CommentsController@create') }}">
					<div class="form-group">
						<label for="comment">@lang('messages.your_answer')</label><br>
						<textarea class="form-control" name="description" id="comment" rows="9" required></textarea>
						<input type="hidden" name="postId" value="{{ $post->id }}">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">@lang('messages.answer')</button>
					</div>
					@csrf
				</form>
			</div>
		@else
			<p>@lang('messages.login_to_answer')</p>
		@endif
</div>
<script>
  $(document).ready(function() {
  	$('textarea').froalaEditor({
  		// heightMin: 100,
      height: 125,
      toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'insertImage', 'insertLink', 'fontFamily' , 'fontSize', 'color', 'paragraphStyle', 'paragraphFormat', 'inlineStyle', 'align', 'indent', 'outdent', 'quote', 'html', 'insertTable', 'undo', 'redo']
		});

  	$('.edit_comment').click(function() {
  		$(this).parent().siblings('.comment').children('.content').siblings('.update_form').show();
  		$(this).parent().siblings('.comment').children('.content').hide();
  		$(this).parent().siblings('.comment').children('.content').siblings('.update_form').children('.form_edit').removeClass('d-none');
  		$(this).hide();
  		$(this).siblings('#delete_comment').hide();
  		$('.add_comment').hide();
  	});

  	$('.cancel').click(function() {
  		$(this).parentsUntil('.content').hide();
  	});
  });
</script>
@endsection