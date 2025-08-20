    @php
    $role = auth()->user()->role ?? 'guest';
    @endphp

    <!-- Navbar -->
    <nav class="navbar">
    <!-- Kiri: Logo -->
    <div class="logo">Magang<span>X</span>code</div>

    <!-- Tengah: Menu Navigasi -->
    <ul class="nav-links" style="position: absolute; left: 50%; transform: translateX(-50%);">
    @if ($role === 'admin')
        <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a></li>
        <li><a href="{{ route('admin.pendaftar') }}" class="{{ request()->routeIs('admin.pendaftar') ? 'active' : '' }}">List Pendaftar</a></li>
        <li><a href="{{ route('admin.history') }}" class="{{ request()->routeIs('admin.trash') ? 'active' : '' }}">History Pendaftar</a></li>
    @else
        <li><a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') || request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
        <li><a href="/dashboard#tentang" class="{{ request()->is('*tentang*') ? 'active' : '' }}">Tentang</a></li>
        <li><a href="/dashboard#program" class="{{ request()->is('*program*') ? 'active' : '' }}">Program</a></li>
        <li><a href="/dashboard#kontak" class="{{ request()->is('*kontak*') ? 'active' : '' }}">Kontak</a></li>
    @endif
</ul>


    <!-- Kanan: Ikon Profil & Logout -->
    <div style="display: flex; align-items: center; gap: 20px;">
        <!-- Profil -->
    <a href="{{ route('profil') }}" class="profil-icon {{ request()->routeIs('profil') ? 'active' : '' }}" title="Profil">
            <i class="fas fa-user-circle fa-2x"></i>
        </a>

        <!-- Logout -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="logout-form">
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
    @if ($role === 'admin')
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('admin.pendaftar') }}">List Pendaftar</a></li>
    @else
        <li><a href="{{ route('user.dashboard') }}">Home</a></li>
        <li><a href="#tentang">Tentang</a></li>
        <li><a href="#program">Program</a></li>
        <li><a href="#kontak">Kontak</a></li>
    @endif
    <li><a href="{{ route('profil') }}">Profil</a></li>
        <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
        </li>
</ul>

  </div>

  <div class="overlay" id="overlay"></div>
    </div>
    </div>
</nav>

