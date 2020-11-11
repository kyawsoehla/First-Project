@extends('layouts.app')
@section('title', 'Posts')
@section('content')
	<div class="container">
		{{-- row --}}
		<div class="row equal justify-content-center mt-3">
			{{-- col-md-6 --}}
			@foreach($posts as $post)
			<div class="col-md-6 d-flex">
				{{-- card --}}
				<div class="card">
					{{-- card-body --}}
					<div class="card-body">
						  {{-- Show Posts --}}
						  <p class="text-danger">{{$post->category->name}}</p>
						  <h4 class="text-dark">{{$post->title}}</h4><hr>
						  <p>{{str_limit($post->description, $limit=250, $end='...')}}</p>
						
						  @foreach($post->images as $image)
						  	<img src="{{'/storage/uploads/'.$image->name}}" class="img-thumbnail mx-2 mt-2" {{-- style="width: 45%; height: 200px;" --}}>
						  @endforeach
						
						  <p>By <span class="text-danger">{{$post->user->name}}</span> &nbsp; &nbsp; &nbsp; &nbsp; <span>{{\Carbon\Carbon::parse($post->created_at)->format('d M, Y')}}</span></p>
						  {{-- End Show Posts --}}
						  {{-- Action --}}
						  <a href="{{route('delete',$post->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete?')">DELETE</a>
						  <a href="{{route('edit',$post->id)}}" class="btn btn-dark">EDIT</a>
						  <a href="{{route('show',$post->id)}}" class="btn btn-primary">Show Detials</a>
						  {{-- End Action --}}

					</div>
					{{-- end card-body --}}
				</div>
				{{-- end card --}}
			</div>
			{{-- end col-md-9 --}}
			@endforeach
		</div> <br>
		{{-- end row --}}
		<div>
				{{$posts->links()}}
			</div>
	</div>
@endsection

