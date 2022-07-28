@extends('master.layout')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if($errors->any())
			<div class="alert alert-danger"> 
				<ul>
				@foreach($errors->all() as $err)
				<li>{{ $err }}</li>
				@endforeach
				</ul>
			</div>
			@endif
				
			<form action="{{ route('store-post') }}" method="POST" enctype="multipart/form-data">
			@csrf
			  <center><h1>Add a Post</h1></center>
			  <div class="mb-3">
			  	<input type="hidden" value="{{ csrf_token() }}" >
			    <label for="exampleInputEmail1" class="form-label">Title</label>
			    <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Image</label>
			    <input type="file" name="image" class="form-control" id="exampleInputPassword1">
			  </div>
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Content</label>
			    <textarea name="body" class="form-control" id="exampleInputPassword1"></textarea>
			  </div>
			  <button type="submit" class="btn btn-primary">Add</button>
			</form>
		</div>
	</div>
</div>

@endsection('content')