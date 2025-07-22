<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .status.delivered { background: #28a745; color: #fff; padding: 4px 8px; border-radius: 4px; }
        .status.pending { background: #ffc107; color: #000; padding: 4px 8px; border-radius: 4px; }
        .status.return { background: #dc3545; color: #fff; padding: 4px 8px; border-radius: 4px; }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="caret-back-outline"></ion-icon>
                        </span>
                        <span class="title">XcodeAdmin</span>
                    </a>
                </li>

                <!-- Dashboard -->
                <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <!-- List Pendaftar -->
                <li class="{{ request()->is('admin/pendaftar*') ? 'active' : '' }}">
                    <a href="{{ route('admin.pendaftar') }}">
                        <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                        <span class="title">List Pendaftar</span>
                    </a>
                </li>

               

                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    </form>

                </li>
            </ul>
        </div>

        <!-- Main content -->
        <div class="main">
            <!-- Topbar -->
            <div class="topbar">
                <div class="toggle"><ion-icon name="menu-outline"></ion-icon></div>
                <div class="search">
            <form id="searchForm" action="{{ route('admin.dashboard') }}" method="GET">
                <label>
                <input 
                    type="text" 
                    name="search" 
                    id="searchInput"
                    placeholder="Cari nama..." 
                    value="{{ request('search') }}"
                    autocomplete="off"
                >
                <ion-icon name="search-outline"></ion-icon>
                </label>
            </form>
            </div>
                <div class="user"><img src="{{ asset('assets/imgs/customer01.jpg') }}" alt="User"></div>
            </div>

            <!-- Cards -->
            <div class="cardBox">
                <div class="card active" data-status="all">
                    <div>
                        <div class="numbers">{{ $total }}</div>
                        <div class="cardName">Total Pendaftar</div>
                    </div>
                    <div class="iconBx"><ion-icon name="person-add-outline"></ion-icon></div>
                </div>

                <div class="card" data-status="diterima">
                    <div>
                        <div class="numbers">{{ $diterima }}</div>
                        <div class="cardName">Diterima</div>
                    </div>
                    <div class="iconBx"><ion-icon name="checkmark-circle-outline"></ion-icon></div>
                </div>

                <div class="card" data-status="pending">
                    <div>
                        <div class="numbers">{{ $pending }}</div>
                        <div class="cardName">Pending</div>
                    </div>
                    <div class="iconBx"><ion-icon name="time-outline"></ion-icon></div>
                </div>

                <div class="card" data-status="ditolak">
                    <div>
                        <div class="numbers">{{ $ditolak }}</div>
                        <div class="cardName">Ditolak</div>
                    </div>
                    <div class="iconBx"><ion-icon name="close-circle-outline"></ion-icon></div>
                </div>
            </div>


            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const cards = document.querySelectorAll('.cardBox .card');
                    const tableRows = document.querySelectorAll('.table-pendaftar tbody tr');

                    function filterRows(status) {
                        tableRows.forEach(row => {
                            const rowStatus = row.dataset.status; // asumsikan ada data-status di setiap row
                            if (status === 'all' || status === rowStatus) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    }

                    cards.forEach(card => {
                        card.addEventListener('click', () => {
                            // Hapus class active dari semua card
                            cards.forEach(c => c.classList.remove('active'));
                            // Tambahkan class active ke card yang diklik
                            card.classList.add('active');

                            const status = card.getAttribute('data-status');
                            filterRows(status);
                        });
                    });

                    // Default tampil semua
                    filterRows('all');
                });
            </script>

            <!-- Details -->
            <div class="details">
               <!-- List Pendaftar -->
                <div class="box list-pendaftar">
                    <div class="cardHeader">
                        <h2>List Pendaftar</h2>
                    </div>
                    <div class="table-wrapper">
                    <table class="table-pendaftar">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Instansi</th>
                                <th>CV</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendaftar as $item)
                                <tr data-status="{{ strtolower($item->status ?? 'pending') }}">
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->instansi }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $item->cv) }}" target="_blank">
                                            📄 Lihat CV
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.updateStatus', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()">
                                                <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="diterima" {{ $item->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                                <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>



                <script>
                    document.getElementById('statusFilter').addEventListener('change', function () {
                        const selected = this.value;
                        const rows = document.querySelectorAll('tbody tr');

                        rows.forEach(row => {
                            const status = row.getAttribute('data-status');
                            if (selected === 'all' || status === selected) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    });
                </script>


                <!-- Recent -->
                <div class="recentTerbaru">
                    <div class="cardHeader2"><h2>Daftar Terbaru</h2></div>
                    <div class="recent-scroll-wrapper">
                    <table>
                        @foreach ($recent as $item)
                            <tr>
                                <td width="60px">
                                    <div class="imgBx"><img src="{{ asset('storage/' . $item->foto) }}" alt="img"></div>
                                </td>
                                <td>
                                    <h4>{{ $item->nama }}<br><span>{{ $item->divisi }}</span></h4>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    </div>
                </div>
            </div>
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

   const searchInput = document.getElementById('searchInput');
  const searchForm = document.getElementById('searchForm');
  let timer;

  searchInput.addEventListener('input', function () {
    clearTimeout(timer); // Reset timer setiap kali user ngetik
    timer = setTimeout(() => {
      searchForm.submit(); // Submit otomatis setelah user berhenti ngetik 0.5 detik
    }, 500); // 500ms jeda ketik
  });



</script>
</body>
</html>
