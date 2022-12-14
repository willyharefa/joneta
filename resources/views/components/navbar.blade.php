<header class="sticky-top shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-4">
        <div class="container-fluid content-wrapper">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('/icon/icon-go-kost-2.png') }}" width="130px" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('daftarKos') }}">Daftar Kost</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Registrasi
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('maintenance') }}">Pengunjung</a></li>
                            <li><a class="dropdown-item" href="{{ route('maintenance') }}">Owner</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex">
                    @if (Auth::guard('owner')->check())
                        <a href="{{ route('owner.index') }}" class="btn btn-primary">Dashboard Saya</a>
                    @endif
                    @if (Auth::guard('web')->check())
                        <a href="{{ route('client.index') }}" class="btn btn-primary">Dashboard Saya</a>
                    @endif
                    @if (Auth::guard('owner')->guest() AND Auth::guard('web')->guest())
                        <a href="{{ route('login.index') }}" class="btn btn-primary">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</header>
