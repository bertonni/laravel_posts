@extends('layouts.app')
<style>
.post-label {
	padding: 10px 5px;
	color: #000;
	transition: 0.7s;
}
.post-label:hover {
	text-decoration: none;
	transition: 0.7s;
	-webkit-transform: scale(1.1);
  -ms-transform: scale(1.1);
  transform: scale(1.1);
}
.post-label a:hover {
	text-decoration: none;

	transition: 0.7s;
}
</style>
@section('content')
<div class="container">
	<h1>Welcome to My Site</h1>
	@if (Auth::check())
		<a href="/posts">Create a Post</a><br/><br/>
		@else
		<h3>You must be logged to create a post.</h3>
		<a href="/login">Login Here.</a>
	@endif
	@if (!empty($posts))
		<h3>Latest posts</h3>
		<div class="row posts">				
			@foreach($posts as $post)
				<div class="col-md-4 post-label">
					<a href="{{ action('PostsController@viewPost', [$post->id]) }}"><b>{{ $post->title }}</b>
					<p class="text-justify">{{ $post->description }}</p></a>
				</div>
			@endforeach
		</div>
		@else
		<h3>There's no recent posts.</h3>
	@endif
</div>
@endsection