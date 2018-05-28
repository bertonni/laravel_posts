@extends('layouts.app')

@section('content')
<div class="container">
	@if (Auth::check())
	<div class="row">
		<div class="col-md-6">
			@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
			@endif
			<h3>Creating your post</h3><br>
			<form method="POST" action="/posts">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Type the title of the post">
				</div>
				@if (!empty($categories))
				<div class="form-group">
					<label for="category">Select the Category</label>
					<select name="category" id="category" class="form-control">
						<option value="default">Select</option>
						@foreach ($categories as $category)
						<option value="{{$category->id}}">{{$category->title}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="new_category">Don't found the category?</label>
					<a href="/addCategory">Add Category</a>
				</div>
				@else
					<div class="form-group">
						<label for="category">Category</label>
						<input type="text" id="category" name="category" class="form-control" placeholder="Type the category">
					</div>
				@endif
				<div class="form-group">
					<label for="description">Description</label>
					<textarea type="text" class="form-control" id="description" rows="5" name="description" placeholder="Type the description of the post"></textarea>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Create</button>
				</div>
				{{ csrf_field() }}
			</form>
		</div>
	</div>
	@else
	<h4>Add New Category</h4>
	<a class="btn btn-primary" href="/addCategory">Add Category</a>
	@endif
</div>
@endsection