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
    <!-- Navbar Desktop -->
    <nav class="navbar">
        <!-- Kiri: Logo -->
        <div class="logo">Xcode</div>

        <!-- Tengah: Menu Navigasi -->
        <ul class="nav-links" style="position: absolute; left: 50%; transform: translateX(-50%);">
            <li><a href="{{ url('/dashboard') }}">Home</a></li>
            <li><a href="{{ url('/dashboard#tentang') }}">Tentang</a></li>
            <li><a href="{{ url('/dashboard#program') }}">Program</a></li>
            <li><a href="{{ url('/dashboard#kontak') }}">Kontak</a></li>
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

    <!-- Navbar Mobile (Hamburger) -->
    <div class="mobile-only">
        <div class="hamburger" id="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </div>

        <div class="side-menu" id="sideMenu">
            <span class="close-btn" id="closeBtn">&times;</span>
            <ul>
                <li><a href="{{ url('/dashboard') }}">Home</a></li>
                <li><a href="{{ url('/dashboard#tentang') }}">Tentang</a></li>
                <li><a href="{{ url('/dashboard#program') }}">Program</a></li>
                <li><a href="{{ url('/dashboard#kontak') }}">Kontak</a></li>
                <li><a href="{{ route('profil') }}">Profil</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <div class="overlay" id="overlay"></div>
    </div>

    {{-- Konten --}}
    <main style="padding-top: 100px;" class="container mx-auto px-4">
        @yield('content')
    </main>

    <script>
        AOS.init();

        // Toggle hamburger menu
        const hamburger = document.getElementById('hamburger');
    const sideMenu = document.getElementById('sideMenu');
    const overlay = document.getElementById('overlay');
    const closeBtn = document.getElementById('closeBtn');

    hamburger.addEventListener('click', () => {
      sideMenu.classList.add('open');
      overlay.classList.add('show');
    });

    closeBtn.addEventListener('click', () => {
      sideMenu.classList.remove('open');
      overlay.classList.remove('show');
    });

    overlay.addEventListener('click', () => {
      sideMenu.classList.remove('open');
      overlay.classList.remove('show');
    });
    </script>
</body>

</html>
