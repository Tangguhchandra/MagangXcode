<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Aplikasi Magang') }}</title>

    <!-- Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Dashboard Custom CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- AOS Animate On Scroll -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

        <style>
        .fade-bg {
            opacity: 0;
            animation: fadeInBg 1.5s ease-in-out forwards;
        }

        @keyframes fadeInBg {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>

</head>

<body class="fade-bg font-sans leading-normal tracking-wide" style="
    background: url('/images/Pemandangan.jpg') no-repeat center center fixed;
    background-size: cover;
    position: relative;">

    {{-- Navbar dari Dashboard --}}
    <!-- Navbar -->
    <nav class="navbar">
    <!-- Kiri: Logo -->
    <div class="logo">Xcode</div>

    <!-- Tengah: Menu Navigasi -->
    <ul class="nav-links" style="position: absolute; left: 50%; transform: translateX(-50%);">
        <li><a href="#">Home</a></li>
        <li><a href="#tentang">Tentang</a></li>
        <li><a href="#program">Program</a></li>
        <li><a href="#kontak">Kontak</a></li>
    </ul>

    <!-- Kanan: Ikon Profil & Logout -->
    <div style="display: flex; align-items: center; gap: 20px;">
        <!-- Profil -->
        <a href="{{ route('profil') }}" class="profil-icon" title="Profil">
          <i class="fas fa-user-circle fa-2x"></i>
        </a>

        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn" title="Logout">
                <i class="fas fa-sign-out-alt fa-lg"></i>
            </button>
        </form>
    </div>
</nav>

    {{-- Konten --}}
    <main style="padding-top: 100px;" class="container mx-auto px-4">
        @yield('content')
    </main>

    <script>
        AOS.init();
    </script>
</body>
</html>
