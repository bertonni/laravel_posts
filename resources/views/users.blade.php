@extends('layouts.app')
@section('content')
<div class="container">
	<form action="{{ action('UsersController@search') }}" method="GET" class="form-inline" id="search-form">
		<input type="text" class="form-control mb-2" id="inlineFormInput" name="text" placeholder="@lang('messages.search_user')">
		<div class="col-auto">
			<button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
		</div>
		@csrf
	</form>
	<h1>@lang('messages.results')</h1>
	<!-- {{ $users->render() }} -->
	@if ($count > 0)
		<div class="list-group users-result">
			@foreach ($users as $user)
			<a class="list-group-item list-group-item-action list-group-item-light" href="{{ action('UsersController@profile', [$user->id]) }}">{{ $user->first_name }} {{ $user->last_name }}</a>
			@endforeach
		</div>
		<p>
			{{ $users->links() }}
		</p>
		@else
		<h3>@lang('messages.user_not_found')</h3>
	@endif
</div>
@endsection