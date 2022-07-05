@extends('layouts.app')

@section('title')
    Create Post
@endsection

@section('content')
<div class="container ">
    <div class="card">
        <div class="card-header ">
        Create Post
        </div>
        <div class="card-body">
            
            <form enctype="multipart/form-data" method="POST" action='/post'>
                @csrf
                <div class="form-group">
                    <label>Picture</label>
                    <input type="file" class="form-control" name="gambar">
                </div>
                <div class="form-group">
                    <label>Caption</label>
                    <textarea class='form-control' row="3" name="caption"></textarea>
                </div>  
                <input type="submit" value="Simpan">
            </form>
        </div>
    </div>
</div>
@endsection