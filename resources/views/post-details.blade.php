@extends('master.layout')

@section('content')


<div class="container">
	@if(session()->has('success'))
		<div class="alert alert-success">{{ session()->get('success') }}</div>
	@endif
	<div class="row">
		<div class="card mb-3">
		  <img src="{{ asset('./uploads/'.$post->image) }}" class="card-img-top" alt="...">
		  <div class="card-body">
		    <h5 class="card-title">{{ $post->title }}</h5>
		    <p class="card-text">{{ $post->body }}</p>
		    <p class="card-text"><small class="text-muted">01/12/2000</small></p>
		  </div>
		</div>		
	</div>
	@if(auth()->user()!==null)
	@if(auth()->user()->id === $post->user_id || auth()->user()->is_admin)
	<a class="btn btn-primary" href=" {{ route('edit-post',$post->slug) }} ">Modify</a>
	<form action="{{ route('delete-post',$post->slug) }}" method="POST">
		@csrf
		<input type="hidden" value="{{ csrf_token() }}">
		<button class="btn btn-danger" onclick="
		event.preventDefault();
		if(confirm('Do you really wanna delete this post?')){
			this.parentElement.submit();
		}
		">Delete</button>
	</form>
	@endif
	@endif
</div>

@endsection