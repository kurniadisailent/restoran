<nav class="navbar shadow navbar-expand-lg navbar-danger bg-danger">
<b class="text-light"> <img src="{{asset('assets/settings/logo3.png')}}" width="40"alt="" srcset="" class="ml-2"> SEAFOOD RESTO </b>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"><i class="fas fa-bars text-light"></i></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link text-light" href="/" id="me">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" id="me">Menu</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="/pelanggan/makanan">Makanan</a>
            <a class="dropdown-item" href="/pelanggan/minuman">Minuman</a>
            <a class="dropdown-item" href="/pelanggan/dessert">Dessert</a>
          </div>
        </li>
      <li class="nav-item dropdown show">
        <a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @if(\Auth::guard('pelanggan')->user())
          {{\Auth::guard('pelanggan')->user()->nama_pelanggan}}
        @else
          Member
        @endif
        </a>        
        <div class="dropdown-menu">
        @if(\Auth::guard('pelanggan')->user())
          <a class="dropdown-item" href="{{route('pelanggan.logout')}}">Logout</a>
        @else
          <a class="dropdown-item" href="{{route('pelanggan.login')}}">Login</a>
          <a class="dropdown-item" href="{{route('pelanggan.daftar')}}">Daftar</a>
        @endif
        </div>
      </li>
    </ul>
  </div>
  <!-- <div class="jutify-content-end">
  <ul class="navbar-nav">
    
    <li class="nav-item">
      <a class="nav-link text-light" href="/keranjang" id="me"><i class="fas fa-shopping-cart"></i><span class="sr-only">(current)</span></a>
    </li>
  </ul>
  </div> -->
</nav>