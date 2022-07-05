@extends('layouts.app')

@section('title')
    {{$post->User->name}}'s Post
@endsection

@section('content')
    <div class='container mx-auto' >
        <div class="row mx-auto">
            <div class="col d-flex justify-content-center p-5 ">
                <img class="mw-100" src="{{asset('imagepost/'.$post->gambar)}}" style="object-fit: contain">
            </div>
            <div class="card col-5">
                <div class="card-header row align-items-center">
                    <img src="{{asset('avatar/'.$post->User->Profile->foto_profile)}}" width="40px" height="40px" class="rounded-circle" style="object-fit: cover">
                    <div class="col">
                        <strong>{{$post->User->name}}</strong>
                    </div>
                    <span class="float-right">
                        @if ($post->user_id==Auth::id())
                        <form action="/post/{{$post->id}}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">
                              Delete Post
                          </button>
                      </form>                    @else
                            
                        @endif
                      </span>
                </div>    
                {{-- for caption --}}
                <div class="card-body" style="height:300px;overflow-y: scroll">
                    <div class="row mb-3">
                        <img src="{{asset('avatar/'.$post->User->Profile->foto_profile)}}" width="40px" height="40px" class="rounded-circle" style="object-fit: cover">
                        <div class="col">
                            <p><strong>{{$post->User->name}}</strong> {{$post->caption}}</p>
                            <p class='text-muted my-2'><small>{{$post->created_at->diffForHumans()}}</small></p>
                        </div>
                    </div>
                {{-- for comment --}}
              
                    @forelse ($post->Comment->where('like',"!=",1) as $item)
                    {{-- {{dd($item->User->Profile->foto_profile)}} --}}
                    <div class="row mb-3">
                        <img src="{{asset('avatar/'.$item->User->Profile->foto_profile)}}" width="40px" height="40px" class="rounded-circle" style="object-fit: cover">
                        <div class="col">
                            <p><strong>{{$item->User->name}}</strong> {{$item->komentar}}</p> 
                            <span>
                                @if ($item->user_id==Auth::id())
                                <form action="/komentar/{{$item->id}}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-outline-danger btn-sm">
                                      Delete
                                  </button>
                              </form>                    @else
                                    
                                @endif
                              </span>
                            <p class='text-muted my-2'><small>{{$post->created_at->diffForHumans()}}</small></p>
                        </div>
                    </div>
                    
                    @empty
                        <p class="text-muted">No comment</p>
                    @endforelse
                
                </div>
                <div class="card-footer">
                    {{-- for add comment --}}
                    @php
                     $condition = $post->Comment->filter(function ($value,$key) {
                            return data_get($value, 'like') == '1' && data_get($value, 'user_id') == Auth::id();
                        })->values();
                    // dd($users)  
                    @endphp
                    @if (count($condition)!=0)
                    {{-- {{dd($condition[0]->id)}} --}}
                    <form action="/komentar/{{$condition[0]->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <button type="submit" style="background: none; padding: 0px; border: none;">
                            <i
                                class="far fa-heart fa-lg"
                                style="color: red; position: relative; font-size: 23px"
                            ></i>
                        </button>
                    </form>
                    @else
                    <form method="POST" action='/komentar'>
                        @csrf
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <input type="hidden" name="like" value="1">
                        <button type="submit" style="background: none; padding: 0px; border: none;" >
                            <i
                                class="far fa-heart fa-lg"
                                style="color: black; position: relative; font-size: 23px"
                            ></i>
                        </button>
                    </form>
                    @endif
                        {{-- {{dd($post->Comment->where('like',1)->count())}} --}}
                        
                        <p><strong>
                            @if ($post->Comment->where('like',1)->count()==0||$post->Comment->where('like',1)->count()==1)
                              {{$post->Comment->where('like',1)->count()}} like
                            @elseif ($post->Comment->count()>1)
                              {{$post->Comment->where('like',1)->count()}} likes
                            @endif
                          </strong></p>
                        <p class="text-muted"><small>{{$post->created_at->format('d M Y')}}</small></p>
                        <form method="POST" action='/komentar'>
                            @csrf
                            <div class="input-group">
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                <input class='form-control' type="text" name="komentar" placeholder="comments...">
                                <div class="input-group-append">
                                    <input class="btn btn-outline-secondary" type='submit' value="post">
                                </div>
                            </div>
                        </form>
                    </div>   
            </div>
        </div>
    </div>
@endsection