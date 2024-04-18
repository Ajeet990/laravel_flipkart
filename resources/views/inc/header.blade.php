<div>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand text-light" href="{{ route('home') }}">Flipkart</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active text-light" aria-current="page" href="{{route('become.a.seller')}}">Become A Seller</a>
              </li>
              
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            @auth('web')
            <ul class="navbar-nav mx-1">
              <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                  {{auth()->user()->name}}
                </button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                  <li><a class="dropdown-item" href="{{route('user.profile')}}">Profile</a></li>
                  <li><a class="dropdown-item" href="{{route('my.cart')}}">My Cart</a></li>
                  <li><a class="dropdown-item" href="{{route('logout')}}">LogOut</a></li>
                </ul>
              </div>
            </ul>
            @else
            <ul class="navbar-nav">
              <li class="nav-item">
                  <a type="button" href="{{route('show_login')}}" class="btn btn-outline-success mx-1">Log In</a>
              </li>
              <li class="nav-item">
                  <a type="button" href="{{route('show_register')}}" class="btn btn-outline-success">Register</a>
              </li>
          </ul>
            @endauth
          </div>
        </div>
      </nav>
</div>