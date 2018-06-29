@extends('layouts.app')

@section('content')
<div class="container">
	@if (Auth::check())
		<div class="row">
			<div class="col-md-9">
				@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
				@endif
				<h3>@lang('messages.create_post')</h3><br>
				<form method="POST" action="/posts">
					<div class="form-group">
						<label for="title">@lang('messages.title')</label>
						<input type="text" class="form-control" id="title" name="title" placeholder="@lang('messages.place_title')" required>
					</div>
					@if (!empty($categories))
						<div class="form-group">
							<label for="category">@lang('messages.select_category')</label>
							<select name="category" id="category" class="form-control" required>
								<option value="default">@lang('messages.select')</option>
								@foreach ($categories as $category)
								<option value="{{$category->id}}">{{$category->title}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="new_category">@lang('messages.category_not_found')</label>
							<a href="{{ action('CategoriesController@add') }}">@lang('messages.add_category')</a>
						</div>
					@else
						<div class="form-group">
							<label for="category">@lang('messages.category')</label>
							<input type="text" id="category" name="category" class="form-control" placeholder="Type the category">
						</div>
					@endif
					<div class="form-group">
						<label for="description">@lang('messages.description')</label>
						<textarea type="text" class="form-control" id="description" rows="5" name="description" placeholder="@lang('messages.place_description')" required></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">@lang('messages.create')</button>
					</div>
					@csrf
				</form>
			</div>
		</div>
	@endif
</div>
<script>
	$(document).ready(function() {
		$('textarea').froalaEditor({
  		// heightMin: 100,
      // heightMax: 300,
      height: 125,
      toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'insertImage', 'insertLink', 'fontFamily' , 'fontSize', 'color', 'paragraphStyle', 'paragraphFormat', 'inlineStyle', 'align', 'indent', 'outdent', 'quote', 'html', 'insertTable', 'undo', 'redo']
		});
	});
</script>
@endsection