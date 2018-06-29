@extends('layouts.app')
@section('content')
<div class="container">
	<h1>@lang('messages.profile', ['name' => $user->first_name ])
		<form action="{{ action('UsersController@search') }}" method="GET" class="form-inline" id="search-form">
			<input type="text" class="form-control mb-2" id="inlineFormInput" name="text" placeholder="@lang('messages.search_user')">
			 <div class="col-auto">
	      <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
	    </div>
	    @csrf
		</form>
	</h1>
	<div class="showData">
		<table class="table table-striped">
			<tr>
				<th>@lang('messages.f_name')</th>
				<td>{{ $user->first_name }}</td>
			</tr>
			<tr>
				<th>@lang('messages.l_name')</th>
				<td>{{ $user->last_name }}</td>
			</tr>
			<tr>
				<th>@lang('messages.about')</th>
				<td>{!! $user->about_me !!}</td>
			</tr>
			<tr>
				<th>@lang('messages.email')</th>
				<td>{{ $user->email }}</td>
			</tr>
			<tr>
				<th>@lang('messages.updated_at')</th>
				<td>{{ date('M d, Y', strtotime($user->updated_at)) }}</td>
			</tr>
		</table>
		@if (Auth::check() && Auth::id() == $user->id )
			<button class="btn btn-primary" id="editProfile">@lang('messages.edit')</button>
		@endif
	</div>
	<div class="editData">
		<form method="POST" action="{{ action('UsersController@update') }}">
			<table class="table table-striped">
				<tr>
					<th>@lang('messages.f_name')</th>
					<td><input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}"></td>
				</tr>
				<tr>
					<th>@lang('messages.l_name')</th>
					<td><input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}"></td>
				</tr>
				<tr>
					<th>@lang('messages.about')</th>
					<td><textarea class="form-control" name="about_me">{!! $user->about_me !!}</textarea></td>
				</tr>
				<tr>
					<th>@lang('messages.email')</th>
					<td><input type="text" class="form-control" name="email" value="{{ $user->email }}"></td>
				</tr>
			</table>
			<button class="btn btn-primary" type="submit">@lang('messages.save')</button>
			<a class="btn btn-danger" id="cancelEdit">@lang('messages.cancel')</a>
			<input type="hidden" name="id" value="{{ $user->id }}">
			@csrf
		</form>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('textarea').froalaEditor({
  		// heightMin: 100,
      // heightMax: 300,
      height: 125,
      toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'insertImage', 'insertLink', 'fontFamily' , 'fontSize', 'color', 'paragraphStyle', 'paragraphFormat', 'inlineStyle', 'align', 'indent', 'outdent', 'quote', 'html', 'insertTable', 'undo', 'redo']
		});
		$('#editProfile').click(function() {
			$('.showData').hide('500');
			$('.editData').show('500');
		});
		$('#cancelEdit').click(function() {
			$('.editData').hide('500');
			$('.showData').show('500');
		});
	});
</script>
@endsection