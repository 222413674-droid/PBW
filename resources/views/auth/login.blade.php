<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BPS Provinsi Sulawesi Selatan</title>
    <link rel="stylesheet" href="{{ asset('assets/css/myCSS.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<header>
    <img src="{{ asset('assets/img/bps.jpg') }}" alt="Logo BPS">
    <div class="judulweb">BPS PROVINSI SULAWESI SELATAN</div>
</header>
<div class="container login-box">
    <h2>Login</h2>
    @if($errors->any()) <p class="login-error">{{ $errors->first() }}</p> @endif
    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required autocomplete="username" value="{{ old('username') }}">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required autocomplete="current-password">
        <input type="submit" value="Login">
    </form>
    <small>Default akun: admin / admin123</small>
</div>
</body>
</html>
