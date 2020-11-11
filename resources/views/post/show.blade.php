@extends('layouts.app')
@section('title', 'Show Posts')
@section('content')
	<div class="container">
		{{-- row --}}
		<div class="row equal justify-content-center mt-3">
			{{-- col-md-6 --}}

			<div class="col-md-6 d-flex">
				{{-- card --}}
				<div class="card">
					{{-- card-body --}}
					<div class="card-body">
						  {{-- Show Posts --}}
						  <p class="text-danger">{{$post->category->name}}</p>
						  <h4 class="text-dark">{{$post->title}}</h4><hr>
						  <p>{{$post->description}}</p>
						  @foreach($post->images as $image)
						  <div class="card-img">
						  	<img src="{{'/storage/uploads/'.$image->name}}" class="img-thumbnail" width="100%">
						  </div><br>
						  @endforeach
						
						  <p>By <span class="text-danger">{{$post->user->name}}</span> &nbsp; &nbsp; &nbsp; &nbsp; <span>{{\Carbon\Carbon::parse($post->created_at)->format('d M, Y')}}</span></p>
						  {{-- End Show Posts --}}

					</div>
					{{-- end card-body --}}
				</div>
				{{-- end card --}}
			</div>
			{{-- end col-md-9 --}}

		</div> <br>
		{{-- end row --}}
	</div>
@endsection

