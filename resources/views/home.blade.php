<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda - MagangXcode</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <!-- Header dengan logo -->
    <header class="header">
        <img src="{{ asset('images/logoxcode.png') }}" alt="Logo X Code" class="logo">
    </header>

    <!-- Konten utama -->
    <div class="container">
        <div class="left-side">
            <img src="{{ asset('images/welcome.png') }}" alt="Ilustrasi Selamat Datang">
        </div>
        <div class="right-side">
            <h1>Welcome!</h1>
            <p>Dapatkan pengalaman kerja nyata, belajar langsung dari para profesional, dan tunjukkan potensimu.<br>
            Mulailah perjalanan magangmu hari ini dan temukan peluang yang sesuai dengan passionmu.</p>
            <div class="buttons">
                <a href="{{ route('register') }}" class="btn btn-red">Daftar</a>
                <a href="{{ route('login') }}" class="btn btn-pink">Masuk</a>
            </div>
        </div>
    </div>
</body>
</html>
