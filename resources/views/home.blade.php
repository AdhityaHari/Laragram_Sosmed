@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
<div class="container">
        <div class="row mx-auto">
            <div class="col-8"> 
              @forelse ($post as $item)
              <div class="card mb-2">
                <div class="card-header">
                  <img
                    src="{{asset('avatar/'.$profile->where('user_id',$item->user_id)->first()->foto_profile)}}"
                    class="rounded-circle"
                    style="width: 35px; height: 35px; border-radius: 50%; object-fit:cover"
                  />
                  <span class="postuserfont"><strong>{{$profile->where('user_id',$item->user_id)->first()->User->name}}</strong></span>
                  <span class="float-right">
                    @if ($item->user_id==Auth::id())
                    <form action="/post/{{$item->id}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">
                          Delete Post
                      </button>
                  </form>                    @else
                        
                    @endif
                  </span>
                </div>
                <img
                  src="{{asset('imagepost/'.$item->gambar)}}"
                  class="card-img-top"
                  alt="..."
                />
                @php
                     $condition = $item->Comment->filter(function ($value,$key) {
                            return data_get($value, 'like') == '1' && data_get($value, 'user_id') == Auth::id();
                        })->values();
                    // dd($users)  
                    @endphp
                    
                <div class="card-body" style="margin-top: -15px">
                  
                
                    @if (count($condition)!=0)
                    {{-- {{dd($condition[0]->id)}} --}}
                    
                    <form action="/komentar/{{$condition[0]->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="post_id" value="{{$item->id}}">
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
                        <input type="hidden" name="post_id" value="{{$item->id}}">
                        <input type="hidden" name="like" value="1">
                        <button type="submit" style="background: none; padding: 0px; border: none;" >
                            <i
                                class="far fa-heart fa-lg"
                                style="color: black; position: relative; font-size: 23px"
                            ></i>
                        </button>
                    </form>
                    @endif
              
                  <p><strong>
                    @if ($item->Comment->where('like',1)->count()==0||$item->Comment->where('like',1)->count()==1)
                      {{$item->Comment->where('like',1)->count()}} like
                    @elseif ($item->Comment->count()>1)
                      {{$item->Comment->where('like',1)->count()}} likes
                    @endif
                  </strong></p>
                  <p class="card-text postuserfont">
                    <strong style="margin-left: -4px; margin-right: 5px"
                      >{{$item->User->name}}</strong
                    >{{$item->caption}}
                  </p>
                  <a href="/post/{{$item->id}}" style="text-decoration: none"
                    ><p
                      class="card-text postuserfont"
                      style="
                        margin-left: -4px;
                        color: rgb(139, 133, 133);
                      "
                    >
                    {{-- {{$item->Comment->where('like','!=',1)->count()}} --}}
                      @if ($item->Comment->where('like','!=',1)->count()==0)
                          No comment
                      @elseif ($item->Comment->where('like','!=',1)->count()==1)
                          1 comment
                      @elseif ($item->Comment->where('like','!=',1)->count()>1)
                          {{$item->Comment->where('like','!=',1)->count()}} comments
                      @endif
                      {{-- 15 comments --}}
                    </p></a
                  >
                  <p
                    class="card-text"
                    style="
                      margin-left: -4px;
                      font-size: 12px;
                      color: rgb(139, 133, 133);
                    "
                  >
                    {{$item->created_at->diffForHumans()}}
                  </p>
                </div>
              </div>
              @empty
                  <p class="text-center">No Post Available</p>
              @endforelse       
              
            </div>
            @include('layouts.partials.sidebar')
          </div>
</div>

@endsection