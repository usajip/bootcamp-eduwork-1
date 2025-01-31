<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Toko Online</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('cart.index')}}">Cart</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        @guest
          <li class="nav-item active">
            <a class="nav-link" href="{{route('login')}}">Login</a>
          </li>
          @if(Route::has('register'))
          <li class="nav-item active">
            <a class="nav-link" href="{{route('register')}}">Register</a>
          </li>
          @endif
        @else
        <li class="nav-item active">
          <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
        </li>
        <li class="nav-item active">
          <form method="POST" action="{{ route('logout') }}">@csrf
            <button class="nav-link btn btn-text" type="submit" href="#!">Logout</button>
              {{-- <x-responsive-nav-link :href="route('logout')"
                      onclick="event.preventDefault();
                                  this.closest('form').submit();">
                  {{ __('Log Out') }}
              </x-responsive-nav-link> --}}
          </form>
        </li>
        @endguest
      </ul>
    </div>
  </nav>