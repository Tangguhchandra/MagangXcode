<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Xcode Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Xcode</div>
        <ul class="nav-links">
            <li><a href="/dashboard">Home</a></li>
            <li><a href="#tentang">Tentang</a></li>
            <li><a href="#program">Program</a></li>
            <li><a href="#kontak">Kontak</a></li>
            <li><a href="{{ route('profil') }}">Profil</a></li>
        </ul>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </nav>

    <!-- Konten halaman -->
    <div class="container">
        @yield('content')
    </div>

</body>
</html>
