<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BPS Provinsi Sulawesi Selatan')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/myCSS.css') }}">
    @stack('styles')
</head>
<body>
<header>
    <a href="{{ route('home') }}" aria-label="Beranda BPS Provinsi Sulawesi Selatan">
        <img src="{{ asset('assets/img/bps.jpg') }}" alt="Logo BPS">
    </a>

    <div class="judulweb">BPS PROVINSI SULAWESI SELATAN</div>

    <nav aria-label="Navigasi utama">
        <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        <a class="{{ request()->routeIs('publikasi.index') ? 'active' : '' }}" href="{{ route('publikasi.index') }}">Daftar Publikasi</a>
        <a class="{{ request()->routeIs('publikasi.create') ? 'active' : '' }}" href="{{ route('publikasi.create') }}">Tambah Publikasi</a>
        <a class="{{ request()->routeIs('galeri.*') ? 'active' : '' }}" href="{{ route('galeri.index') }}">Galeri</a>

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="nav-logout">Logout</button>
        </form>
    </nav>
</header>

@if(session('success'))
    <div class="container">
        <div class="alert alert-success">{{ session('success') }}</div>
    </div>
@endif

@if($errors->any())
    <div class="container">
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@yield('content')
@stack('scripts')
</body>
</html>
