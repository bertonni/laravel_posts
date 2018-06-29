@extends('layouts.app')
@section('content')
<div class="container">
	<h1>@lang('messages.welcome')</h1>
	@if (Auth::check())
		<a href="{{ action('PostsController@add') }}">@lang('messages.create_post')</a><br/><br/>
		@else
		<p>@lang('messages.must_be_logged')</p>
	@endif
	@if (sizeof($posts) > 0)
		<h3>@lang('messages.latest_posts')</h3>
		<div class="row">				
			@foreach($posts as $post)
				<div class="col-md-4 posts">
					<a href="{{ action('PostsController@viewPost', [$post->id]) }}"><b>{{ $post->title }}</b>
					<p class="text-justify">{{ $post->description }}</p>
					<span>@lang('messages.created_at') {{ date('M d, Y', strtotime($post->created_at)) }}</span><br>
				</a>
				</div>
			@endforeach
		</div>
		@else
		<h3>@lang('messages.no_recent_posts')</h3>
	@endif
</div>
@endsection