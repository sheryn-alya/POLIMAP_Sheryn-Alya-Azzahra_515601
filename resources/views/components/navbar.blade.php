<style>
.navbar-custom {
    background-color: #00188e !important;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
}

.navbar-custom .nav-link,
.navbar-custom .navbar-brand,
.navbar-custom .dropdown-toggle {
    color: white !important;
    letter-spacing: 0.5px;
    transition: 0.3s ease;
}

.navbar-custom .nav-link:hover,
.navbar-custom .navbar-brand:hover,
.navbar-custom .dropdown-toggle:hover {
    background-color: #1f3cd6 !important;
    color: #ffffff !important;
}

.navbar-custom .dropdown-menu {
    background-color: #00188e;
    border: none;
    font-family: 'Poppins', sans-serif;
}

.navbar-custom .dropdown-item {
    color: white;
    font-weight: 500;
}

.navbar-custom .dropdown-item:hover {
    background-color: #1f3cd6;
    color: white;
}
</style>


<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="fa-solid fa-earth-asia"></i> {{ $title }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left menu -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">
                        <i class="fa-solid fa-house"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('map') }}">
                        <i class="fa-solid fa-map"></i> Peta
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('table') }}">
                        <i class="fa-solid fa-table"></i> Tabel
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-database me-1"></i> Data
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('api.points') }}" target="_blank">Lokasi Polisi</a></li>
                        <li><a class="dropdown-item" href="{{ route('api.polylines') }}" target="_blank">Jarak</a></li>
                        {{-- <li><a class="dropdown-item" href="{{ route('api.polygons') }}" target="_blank">Polygons</a></li> --}}
                    </ul>
                </li>
            </ul>

            <!-- Right menu -->
            <ul class="navbar-nav mb-2 mb-lg-0">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fa-solid fa-right-to-bracket"></i> Login
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fa-solid fa-user-plus"></i> Register
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ url('/dashboard') }}">
                                <i class="fa-solid fa-gauge"></i> Dashboard
                            </a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
