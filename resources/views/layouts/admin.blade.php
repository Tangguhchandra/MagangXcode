<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .status.delivered { background: #28a745; color: #fff; padding: 4px 8px; border-radius: 4px; }
        .status.pending { background: #ffc107; color: #000; padding: 4px 8px; border-radius: 4px; }
        .status.return { background: #dc3545; color: #fff; padding: 4px 8px; border-radius: 4px; }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="caret-back-outline"></ion-icon></span>
                        <span class="title">XcodeAdmin</span>
                    </a>
                </li>

                <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li class="{{ request()->is('admin/pendaftar*') ? 'active' : '' }}">
                    <a href="{{ route('admin.pendaftar') }}">
                        <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                        <span class="title">List Pendaftar</span>
                    </a>
                </li>

                <li class="{{ request()->is('admin/trash') ? 'active' : '' }}">
                    <a href="{{ route('admin.trash') }}">
                        <span class="icon"><ion-icon name="trash-outline"></ion-icon></span>
                        <span class="title">History Pendaftar</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Sign Out</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main">
            <!-- Topbar -->
            <div class="topbar">
                <div class="toggle"><ion-icon name="menu-outline"></ion-icon></div>
                <div class="search">
                    @php
                        $currentRoute = '';
                        if (request()->is('admin/pendaftar*')) {
                            $currentRoute = route('admin.pendaftar');
                        } elseif (request()->is('admin/trash')) {
                            $currentRoute = route('admin.trash');
                        } else {
                            $currentRoute = route('admin.dashboard');
                        }
                    @endphp
                    <form id="searchForm" method="GET" action="{{ $currentRoute }}">
                        <label>
                            <input type="text" name="search" id="searchInput" placeholder="Cari nama..."
                                value="{{ request('search') }}" autocomplete="off">
                            <ion-icon name="search-outline"></ion-icon>
                        </label>
                    </form>
                </div>
                <div class="user">
                    <img src="{{ asset('/images/profile.png') }}" alt="User">
                </div>
            </div>

            <!-- Dynamic Page Content -->
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
    document.querySelectorAll(".navigation li").forEach((item) => {
        item.addEventListener("mouseover", function () {
            document.querySelectorAll(".navigation li").forEach((el) => el.classList.remove("hovered"));
            this.classList.add("hovered");
        });
    });

    let toggle = document.querySelector(".toggle");
    let navigation = document.querySelector(".navigation");
    let main = document.querySelector(".main");

    toggle.onclick = function () {
        navigation.classList.toggle("active");
        main.classList.toggle("active");
    };

    // ===== Auto Search tanpa Enter (AJAX) =====
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');
    let timer;

    searchInput.addEventListener('input', function () {
        clearTimeout(timer);
        timer = setTimeout(() => {
            let query = searchInput.value;
            let url = searchForm.action + '?search=' + encodeURIComponent(query);

            fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => {
                let parser = new DOMParser();
                let doc = parser.parseFromString(html, 'text/html');
                let newContent = doc.querySelector('#searchableContent');
                if (newContent) {
                    document.querySelector('#searchableContent').innerHTML = newContent.innerHTML;
                }
            });
        }, 300); // delay biar ga spam
    });
</script>


    @stack('scripts')
</body>

</html>
