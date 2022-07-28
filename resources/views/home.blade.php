@extends('master.layout')

@section('content')

<div class="container" style="margin-top:50px">

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success')}}
        </div>
    @endif

    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-4">
                <div class="card" style="width: 18rem; ">
                  <img src="{{ asset('./uploads/'.$post->image) }}" class="card-img-top" width="18rem" height="200px" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ Str::limit($post->body,100) }}</p>
                    <p class="card-text"><small class="text-muted">By : {{$post->user ? $post->user->name : null
                    }}</small></p>
                    <a href="{{ route('post-details',$post->slug) }}" class="btn btn-primary">See</a>
                  </div>
                </div>
            </div>
        @endforeach
    
    </div>
    <div class="row" style="margin-top:20px">
        {{$posts->links()}}
    </div>
</div>

@endsection