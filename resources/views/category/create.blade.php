@extends('layouts.app')
@section('title', 'Create_Category')
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
						{{-- category form --}}
						<form method="POST" action="{{route('category_store')}}">
							@csrf
						  <div class="form-group">
						    <label>Category</label>
						    <input type="text" class="form-control" name="name">
						    {{-- error --}}
						    @error('name')
						    	<div class="text-danger font-weight-bold">{{$message}}</div>
						    @enderror
						    {{-- end error --}}
						  </div>
						  <button type="submit" class="btn btn-primary">Create</button>
						</form>
						{{-- end category form --}}
					</div>
					{{-- end card-body --}}
				</div>
				{{-- end card --}}
			</div>
			{{-- end col-md-9 --}}
		</div>
		{{-- end row --}}

		{{-- Show Categories --}}
		<div class="row justify-content-center mt-3">
			{{-- col-md-9 --}}
			<div class="col-md-9">
				{{-- card --}}
				<div class="card">
					{{-- card-body --}}
					<div class="card-body">
						{{-- table --}}
						<table class="table table-hover">
							{{-- table header --}}
							<thead class="text-danger font-weight-bold">
								<tr>
									<td>No</td><td>Name</td><td>Created_at</td><td>Action</td>
								</tr>
							</thead>
							{{-- end table header --}}

							{{-- table body --}}
							<tbody>
								@foreach($categories as $key=>$category)
								<tr>
									<td>{{++$key}}</td>
									<td>{{$category->name}}</td>
									<td>{{\Carbon\Carbon::parse($category->created_at)->format('D m, Y')}}</td>
									<td><a href="">Edit</a> <a href="">Delete</a></td>
								</tr>
								@endforeach
							</tbody>
							{{-- end table body --}}
						</table>
						{{-- end table --}}
						<div class="text-center">
							{{$categories->links()}}
						</div>
					</div>
					{{-- end card-body --}}
				</div>
				{{-- end card --}}
			</div>
			{{-- end col-md-9 --}}
		</div>
		{{-- end Show Categories --}}
	</div>
@endsection

