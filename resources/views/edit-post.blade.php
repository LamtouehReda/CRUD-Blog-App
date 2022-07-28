@extends('master.layout')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('store-edited-post',$post->slug) }}" method="POST" enctype="multipart/form-data">
				@csrf
				<input type="hidden" value="{{ csrf_token() }}">
			  <center><h1>Edit the postt</h1></center>
			  <div class="mb-3">
			    <label for="exampleInputEmail1" class="form-label" >Title</label>
			    <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $post->title }}">
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Image</label>
			    <input type="file" name="image" class="form-control" id="exampleInputPassword1">
			  </div>
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Content</label>
			    <textarea name="body" class="form-control" id="exampleInputPassword1">{{ $post->body }}
			    </textarea>
			  </div>
			  <button type="submit" class="btn btn-primary">Edit</button>
			</form>
		</div>
	</div>
</div>

@endsection('content')