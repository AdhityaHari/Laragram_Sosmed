@extends('layouts.app')
@section('title')
    Profile
@endsection

@section('content')
<div class="col-8 offset-2 middlearea">
    <div class="row py-1 ">
      <div class='col-3 mr-5'>
            <img src="{{asset('avatar/'.$profile->foto_profile)}}" width="150" height="150" style="object-fit:cover" class="rounded-circle mb-3">
      </div>
      <div class='col '>
        <div class="row ml-1 py-auto">
          <h2 class="mr-3">{{$profile->User->name}}</h2>
          <a class="btn btn-light border d-flex align-items-center" href="/profile/{{Auth::id()}}/edit">Edit Profile</a>
        </div>
        <strong>{{$post->count()}} 
        @if ($post->count()<=1)
        post 
        @else
        posts    
        @endif</strong>
        <p>Age: {{$profile->umur}}</p>
        <p>Bio: {{$profile->bio}}</p>
        <p>Address: {{$profile->alamat}}</p>
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-center"><h3>POSTS</h3></div>
  <div class="col-6 mx-auto border bg-light">
    @if ($post->count()==0)
    <div class="d-flex justify-content-center align-items-center p-5">
      <a class='btn btn-primary' href="/post/create">Create Your First Post</a> 
    </div>  
    @else
    @foreach($post->chunk(3) as $chunk)
        <div class="row">
        @foreach($chunk as $add)
            <img class='img-thumbnail' src="{{asset('imagepost/'.$add->gambar)}}" width="210" height="210" style="object-fit:cover">  
        @endforeach
        </div>
    @endforeach
  </div>
    @endif
  
@endsection
