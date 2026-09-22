<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BPS Provinsi Sulawesi Selatan</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/myCSS.css') }}">
</head>
<body>
<header>
    <a href="{{ route('login') }}" aria-label="BPS Provinsi Sulawesi Selatan">
        <img src="{{ asset('assets/img/bps.jpg') }}" alt="Logo BPS">
    </a>
    <div class="judulweb">BPS PROVINSI SULAWESI SELATAN</div>
</header>

<main class="login-page">
    <section class="login-shell">
        <div class="login-brand">
            <img src="{{ asset('assets/img/bps.jpg') }}" alt="Logo BPS">
            <span class="eyebrow">PORTAL DATA STATISTIK</span>
            <h1>Selamat Datang</h1>
            <p>
                Masuk untuk mengelola publikasi dan mengakses dashboard
                statistik BPS Provinsi Sulawesi Selatan.
            </p>
        </div>

        <div class="login-panel">
            <h2>Login</h2>
            <p class="login-subtitle">Silakan masuk menggunakan akun yang terdaftar.</p>

            @if($errors->any())
                <div class="login-error">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <label for="username">Username</label>
                <input type="text" id="username" name="username" required autocomplete="username" value="{{ old('username') }}">

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password">

                <input type="submit" value="Masuk ke Dashboard">
            </form>

            <p class="login-demo">Akun demo: admin / admin123</p>
        </div>
    </section>
</main>
</body>
</html>
