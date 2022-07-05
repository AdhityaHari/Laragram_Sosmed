@extends('layouts.app')

@section('title')
    Edit Profile
@endsection

@section('content')
<div class="container mx-auto">
    <div class="card">
        <div class="card-header">
        Edit Profile
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                    <img src="{{asset('avatar/'.$profile->foto_profile)}}" width="200px" class="rounded-circle mb-3">               
            </div>
            
            <form enctype="multipart/form-data" method="POST" action='/profile/{{Auth::id()}}'>
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Profile Picture</label>
                    <input type="file" class="form-control" name="foto_profile">
                </div>
                <div class="form-group">
                    <label>umur</label>
                    <input type="text" class="form-control" placeholder="Umur" name='umur' value="{{$profile->umur ??''}}">
                </div>
                <div class="form-group">
                    <label>bio</label>                    
                    <input type="text" class="form-control" placeholder="Bio" name='bio' value="{{$profile->bio ??''}}">
                </div>
                <div class="form-group">
                    <label>alamat</label>
                    <input type="text" class="form-control" placeholder="Alamat" name='alamat' value="{{$profile->alamat ??''}}">
                </div>
                <input type="submit" value="Simpan" class="btn btn-outline-secondary">
            </form>
        </div>
    </div>
</div>
@endsection