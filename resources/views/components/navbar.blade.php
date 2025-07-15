    <!-- Navbar -->
    <nav class="navbar">
    <!-- Kiri: Logo -->
    <div class="logo">Magang<span>X</span>code</div>

    <!-- Tengah: Menu Navigasi -->
    <ul class="nav-links" style="position: absolute; left: 50%; transform: translateX(-50%);">
        <li><a href="/dashboard">Home</a></li>
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
    <div class="mobile-only">
    <div class="hamburger" id="hamburger">
    <div></div>
    <div></div>
    <div></div>
  </div>

  <div class="side-menu" id="sideMenu">
    <span class="close-btn" id="closeBtn">&times;</span>
    <ul>
      <li><a href="/dashboard">Home</a></li>
      <li><a href="#tentang">Tentang</a></li>
      <li><a href="#program">Program</a></li>
      <li><a href="#kontak">Kontak</a></li>
      <li><a href="{{ route('profil') }}">Profil</a></li>
      <li><a href="{{ route('logout') }}">Logout</a></li>
    </ul>
  </div>

  <div class="overlay" id="overlay"></div>
    </div>
    </div>
</nav>

