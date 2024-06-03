<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo"><a href="{{ route('index') }}">{{ $appName }}</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link @if (Route::currentRouteName() == 'index') active @endif"
                        href="{{ route('index') }}">Beranda</a></li>
                <li><a class="nav-link @if (Route::currentRouteName() == 'karya') active @endif"
                        href="{{ route('karya') }}">Karya</a></li>
                <li><a class="nav-link @if (Route::currentRouteName() == 'berita') active @endif"
                        href="{{ route('berita') }}">Berita</a></li>
                <li><a class="nav-link @if (Route::currentRouteName() == 'login') active @endif"
                        href="{{ route('login') }}">Login</a></li>
                {{-- <li><a class="nav-link" href="#contact">Kontak Kami</a></li> --}}
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
