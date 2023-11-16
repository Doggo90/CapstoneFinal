<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl
        {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }}" id="navbarBlur"
        data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <a href="/dashboard" style="text-decoration: none; color:black; ">
            <h3>CV<span>SU</span></h3>
        </a>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

            {{-- SEARCH BUTTON --}}
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here...">
                </div>
            </div>
            {{-- END SEARCH BUTTON --}}
            @auth
            <div class="btn-group mt-3">
                <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    {{auth()->user()->name}}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    @if (auth()->user()->role == "admin")
                    <li><a class="dropdown-item" href="{{route('archives')}}">Archived Posts</a></li>
                    @endif
                    <li>
                        <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <a href="{{ route('logout') }}" style="text-decoration: none; color:black; "
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="nav-link text-black dropdown-item">
                                Log Out
                            </a>
                        </form>
                    </li>
                </ul>
              </div>
            @else
            <div class="btn-group mt-3">
                <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Guest
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/login">Login</a></li>
                  <li><a class="dropdown-item" href="/register">Register</a></li>

                </ul>
              </div>
            @endauth
        </div>
    </div>
</nav>
<!-- End Navbar -->
