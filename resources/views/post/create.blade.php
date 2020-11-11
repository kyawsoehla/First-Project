@extends('layouts.app')
@section('title', 'Create_Posts')
@section('content')
	<div class="container">
		{{-- row --}}
		<div class="row justify-content-center mt-3">
			{{-- col-md-9 --}}
			<div class="col-md-9">
				{{-- card --}}
				<div class="card">
					{{-- card-body --}}
					<div class="card-body">
						  {{-- Post form --}}
						<form method="POST" action="{{route('store')}}" enctype="multipart/form-data">
							@csrf
						  {{-- title --}}
						  <div class="form-group">
						    <label>Title</label>
						    <input type="text" class="form-control" name="title" value="{{old('title')}}">
						    {{-- error --}}
						    @error('title')
						    	<div class="text-danger font-weight-bold">{{$message}}</div>
						    @enderror
						    {{-- end error --}}
						  </div>
						  {{-- end title --}}

						  {{-- category --}}
						  <div class="form-group">
						    <label>Category</label>
						    <select name="category" class="form-control">
						    	@foreach($categories as $category)
						    	<option value="{{$category->id}}" {{($category->id==old('category'))?'selected':null}}>
						    		{{$category->name}}
						    	</option>
						    	@endforeach
						    </select>
						  </div>
						  {{-- end category --}}

						  {{-- description --}}
						  <div class="form-group">
						  	<label>Description</label>
						  	<textarea name="description" class="form-control" rows="12">{{old('description')}}</textarea>
						  	@error('description')
						  		<div class="text-danger font-weight-bold">{{$message}}</div>
						  	@enderror
						  </div>
						  {{-- end description --}}

						  {{-- image --}}
						  <div class="form-group">
						  	<label>Image</label>
						  	<input type="file" multiple name="files[]" class="form-control">
						  	@error('image')
						  		<div class="text-danger font-weight-bold">{{$message}}</div>
						  	@enderror
						  </div>
						  {{-- end image --}}

						  <button type="submit" class="btn btn-primary">Create</button>
						</form>
						{{-- end Post form --}}
					</div>
					{{-- end card-body --}}
				</div>
				{{-- end card --}}
			</div>
			{{-- end col-md-4 --}}
		</div>
		{{-- end row --}}
	</div>
@endsection

