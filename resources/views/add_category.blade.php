@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-9">
			@if (Auth::check())
				<h2>@lang('messages.add_category')</h2>
				@if ($errors->any())
	    		<div class="alert alert-danger">
	        	<ul>
	            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
	            @endforeach
	        	</ul>
	    		</div>
				@endif
				<form method="POST" action="/addCategory">
					<div class="form-group">
						<input name="title" class="form-control" placeholder="@lang('messages.place_add_category')" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">@lang('messages.add_category')</button>
					</div>
				@csrf
			</form>
			@endif
		</div>
	</div>
</div>
@endsection