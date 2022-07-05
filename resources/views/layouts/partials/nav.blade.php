<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
  <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
          <strong>Laragram</strong>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          @guest
          
          @if (Route::has('register'))
              
          @endif
      @else
      <ul class="navbar-nav mr-auto">
          <div class="collapse navbar-collapse ml-5 d-flex justify-content-center">
              <form class="form-inline my-2 my-lg-0 ml-5 d-none d-sm-block">
                <input
                  class="form-control mr-sm-2 empty"
                  type="search"
                  placeholder="Search"
                  style="font-family: Arial, FontAwesome; height: 28px; width: 216px"
                  aria-label="Search"
                />
              </form>   
            </div>
      </ul>
      @endguest
          

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
              @guest
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                      </li>
                  @endif
              @else
                  <li class="nav-item active">
                      <a class="nav-link" href="/home">
                          <i class="fas fa-home fa-lg mr-2 d-none d-sm-block mt-1"></i>
                          <span class="sr-only">(current)</span>
                      </a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="/post/create">
                        <i class="fas fa-plus fa-lg mr-2 d-none d-sm-block mt-1"></i>
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                  <li class="nav-item">
                      <a
                          class="nav-link d-none d-sm-block"
                          href="/profile"
                      >
                        <img src="{{asset('avatar/'.Auth::user()->Profile->foto_profile)}}" width="30" height="30" style="object-fit:cover" class="rounded-circle">
                      </a>
                </li>
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                      </div>
                  </li>
              @endguest
          </ul>
      </div>
  </div>
</nav>