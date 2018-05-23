@extends('layouts.app')

@section('content')
<div class="container">
	@if (Auth::check())
		<h2>Add New Category</h2>
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
			<div class="col-md-6">
				<div class="form-group">
					<input name="title" class="form-control" placeholder="Type the category">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Add Category</button>
				</div>
			</div>
			{{ csrf_field() }}
		</form>
	@endif
</div>
@endsection