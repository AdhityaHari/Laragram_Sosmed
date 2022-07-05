<div class="col-4">
  <div class="card">
    <div class="card-body d-flex" >
      <div>
        <a class="nav-link" href="#"
          >
          <span>
          <img
            src="{{asset('avatar/'.Auth::user()->Profile->foto_profile)}}"
            class="rounded-circle"
            style="
              width: 60px;
              height: 60px;
              object-fit:cover;
              margin-left: -15px;
            "
          /><span
            class=""
            style="
              font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI',
                Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans',
                'Helvetica Neue', sans-serif;
              font-size: 15px;
              color: black;
              margin-left: 20px;
            "
            ><strong>{{Auth::user()->name}}</strong>
            </span>
          </span>
        </a>
        <div class="mt-2">
          <span
            class="mt-5"
            style="
              font-family: 'Segoe UI', Tahoma, Geneva, Verdana,
                sans-serif;
              font-size: 15px;
              color: gray;
            "
            >Suggestions for You</span
          >
        </div>
        <div class="mt-2 ml-2">
          <div>
            @forelse ($filtered->all() as $item)
              <div>
                <a href="/profile/{{$item->id}}">
                  <img
                  src="{{asset('avatar/'.$item->Profile->foto_profile)}}"
                  style="width: 30px; height: 30px; border-radius: 50%; object-fit:cover"
                  class="my-1"
                  >
                  {{$item->name}}
                </a>
              </div>
            @empty
                <small>No Suggested User</small>
            @endforelse
          </div>
        </div>
        <div class="ml-2 mt-2" style="color: lightgray; font-size: 11px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">
          <p style="font-size: 12px;">© {{gmdate('Y',time())}} INSTAGRAM</p>
        </div>
      </div>
    </div>
  </div>
</div>