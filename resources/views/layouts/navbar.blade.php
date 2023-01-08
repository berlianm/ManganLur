 <nav class="navbar navbar-expand-lg navbar-light bg-light">
     <div class="container">
         <a class="navbar-brand" href="{{ url('/') }}">
             <img src="{{ asset('images/logoTitle.png') }}" alt="logo" width="30" height="24"
                 class="d-inline-block align-text-top">
             ManganLur
         </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
             aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav ms-auto">
                 @guest
                     <li class="nav-item">
                         <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                     </li>
                 @endguest
                 @auth
                     @if (Auth::user()->role == 'user')
                         <li class="nav-item">
                             <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                         </li>
                     @endif
                 @endauth
                 @auth
                     @if (Auth::user()->role == 'restoran')
                         <li class="nav-item ">
                             <a class="nav-link " href="{{ url('/restoranku') }}">Restoranku</a>
                         </li>
                     @endif
                 @endauth
                 <li class="nav-item">
                     @guest
                         <div class="dropdown">
                             <button class=" btn btn-secondary dropdown-toggle tombol" type="button"
                                 id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                 <i class="fas fa-sign-in-alt"></i> Login
                             </button>
                             <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                 <li>
                                     <a class="dropdown-item" href="{{ url('/login') }}">Sign in</a>

                                 </li>
                                 <li>
                                     <a class="dropdown-item" href="{{ url('/register') }}">Registrasi</a>
                                 </li>

                             </ul>
                         </div>
                     @endguest
                     @auth
                         <div class="dropdown">
                             <button class="btn btn-secondary dropdown-toggle tombol" type="button"
                                 id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                 <i class="fas fa-User"></i> {{ Auth::user()->name }}
                             </button>
                             <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                 {{-- <li>
                                     <a class="dropdown-item" href="{{ url('/edot-profile') }}">Edit Profile</a>

                                 </li> --}}
                                 <li>
                                     <a class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
                                 </li>

                             </ul>
                         </div>
                     @endauth


                 </li>

             </ul>
         </div>
     </div>
 </nav>
