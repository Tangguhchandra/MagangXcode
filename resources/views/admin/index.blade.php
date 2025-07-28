<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .status.delivered {
            background: #28a745;
            color: #fff;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .status.pending {
            background: #ffc107;
            color: #000;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .status.return {
            background: #dc3545;
            color: #fff;
            padding: 4px 8px;
            border-radius: 4px;
        }
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
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                            <input type="text" name="search" id="searchInput" placeholder="Cari nama..."
                                value="{{ request('search') }}" autocomplete="off">
                            <ion-icon name="search-outline"></ion-icon>
                        </label>
                    </form>
                </div>
                <div class="user"><img src="{{ asset('/images/profile.png') }}" alt="User"></div>
            </div>

            <!-- Cards -->
<div class="cardBox">
    <div class="card active" data-status="all">
        <div>
            <div class="numbers" id="total-count">{{ $total }}</div>
            <div class="cardName">Total Pendaftar</div>
        </div>
        <div class="iconBx"><ion-icon name="person-add-outline"></ion-icon></div>
    </div>

    <div class="card" data-status="diterima">
        <div>
            <div class="numbers" id="diterima-count">{{ $diterima }}</div>
            <div class="cardName">Diterima</div>
        </div>
        <div class="iconBx"><ion-icon name="checkmark-circle-outline"></ion-icon></div>
    </div>

    <div class="card" data-status="pending">
        <div>
            <div class="numbers" id="pending-count">{{ $pending }}</div>
            <div class="cardName">Pending</div>
        </div>
        <div class="iconBx"><ion-icon name="time-outline"></ion-icon></div>
    </div>

    <div class="card" data-status="ditolak">
        <div>
            <div class="numbers" id="ditolak-count">{{ $ditolak }}</div>
            <div class="cardName">Ditolak</div>
        </div>
        <div class="iconBx"><ion-icon name="close-circle-outline"></ion-icon></div>
    </div>
</div>



            <script>
                document.addEventListener('DOMContentLoaded', function() {
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
                                <th>portofolio</th>
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
                                        @if ($item->portofolio)
                                            <a href="{{ asset('storage/' . $item->portofolio) }}" target="_blank">
                                                📂 Lihat Portofolio
                                            </a>
                                        @else
                                            <span style="color: gray;">Tidak ada portofolio</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form class="form-status" data-id="{{ $item->id }}">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="submitStatusViaAjax(this)">
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

                <!-- Loading -->
                <div id="status-loader-popup">
                <div class="popup-box">
                    <div class="spinner"></div>
                    <p>Mengubah status...</p>
                </div>
                </div>

                
                <!-- JS Loading -->
                <script>
                function submitStatusViaAjax(selectElement) {
                    const form = selectElement.closest('.form-status');
                    const id = form.dataset.id;
                    const newStatus = selectElement.value;
                    const popup = document.getElementById('status-loader-popup');

                    // Tampilkan loading popup
                    popup.style.display = 'flex';

                    fetch(`{{ route('admin.updateStatus', ':id') }}`.replace(':id', id), {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ status: newStatus })
                    })
                    .then(response => response.json())
                    .then(data => {
                        popup.style.display = 'none';

                        if (data.success) {
                            showToast('success', data.message || 'Status berhasil diperbarui');
                            location.reload();
                        } else {
                            showToast('error', data.message || 'Gagal memperbarui status');
                        }
                    })
                    .catch(error => {
                        popup.style.display = 'none';
                        showToast('error', 'Terjadi kesalahan saat update.');
                    });
                }

                </script>

                <!-- JS Toast Notification -->
                <script>
                function showToast(type, message) {
                    const toast = document.createElement('div');
                    toast.className = `toast toast-${type}`;
                    toast.innerText = message;
                    document.body.appendChild(toast);

                    setTimeout(() => toast.classList.add('show'), 100);
                    setTimeout(() => {
                        toast.classList.remove('show');
                        setTimeout(() => toast.remove(), 500);
                    }, 3000);
                }
                </script>



                <script>
                    document.getElementById('statusFilter').addEventListener('change', function() {
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
                    <div class="cardHeader2">
                        <h2>Daftar Terbaru</h2>
                    </div>
                    <div class="recent-scroll-wrapper">
                        <table>
                            @foreach ($recent as $item)
                                <tr>
                                    <td width="60px">
                                        <div class="imgBx"><img src="{{ asset('storage/' . $item->foto) }}"
                                                alt="img"></div>
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

    <!-- Scripts Nav,Search,Select Dll -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        document.querySelectorAll(".navigation li").forEach((item) => {
            item.addEventListener("mouseover", function() {
                document.querySelectorAll(".navigation li").forEach((el) => el.classList.remove("hovered"));
                this.classList.add("hovered");
            });
        });

        let toggle = document.querySelector(".toggle");
        let navigation = document.querySelector(".navigation");
        let main = document.querySelector(".main");

        toggle.onclick = function() {
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

    document.querySelectorAll('select[name="status"]').forEach(select => {
        function updateColorClass(el) {
            el.classList.remove('pending', 'diterima', 'ditolak');
            const val = el.value;
            el.classList.add(val);
        }

        updateColorClass(select); // initial
        select.addEventListener('change', function () {
            updateColorClass(this);
        });
    });

</script>

</body>

</html>
