<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List Pendaftar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/listpendaftar.css') }}">
    <style>
        .status.delivered { background: #28a745; color: #fff; padding: 4px 8px; border-radius: 4px; }
        .status.pending { background: #ffc107; color: #000; padding: 4px 8px; border-radius: 4px; }
        .status.return { background: #dc3545; color: #fff; padding: 4px 8px; border-radius: 4px; }
        .card-container::-webkit-scrollbar {
        width: 8px;
    }

    .card-container::-webkit-scrollbar-thumb {
        background-color: rgba(0,0,0,0.2);
        border-radius: 4px;
    }

    .card-container {
        scroll-behavior: smooth;
    }

    </style>

    <!-- Ionicons CDN -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    
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

                <li>
                    <a href="/admin/dashboard">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.pendaftar') }}">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
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
                <div class="search"><label><input type="text" placeholder="Search here"><ion-icon name="search-outline"></ion-icon></label></div>
                <div class="user"><img src="{{ asset('assets/imgs/customer01.jpg') }}" alt="User"></div>
            </div>

            <!-- CARD -->
            <div class="card-container" style="max-height: 90vh; overflow-y: auto; margin-top: 10px;">

                @foreach ($pendaftars as $item)
                    <div class="pendaftar-card"  >
                        <h3>{{ $item->nama }}</h3>
                        <p><strong>Instansi:</strong> {{ $item->instansi }}</p>
                        <p><strong>Email:</strong> {{ $item->email }}</p>
                        <p><strong>Status:</strong> 
                            <span class="status {{ $item->status ?? 'pending' }}">
                                {{ ucfirst($item->status ?? 'pending') }}
                            </span>
                        </p>
                        <button 
                            type="button" 
                            class="btn-detail" 
                            data-id="{{ $item->id }}">
                            Detail
                        </button>

                    </div>
                @endforeach
            </div>

            <div id="detailModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close-btn" onclick="closeModal()">&times;</span>
                    <h3>Detail Pendaftar</h3>
                    <div id="modalContent">Loading...</div>
                    <div id="actionButtons" style="margin-top: 20px; text-align: right; display: none;">
                    <button onclick="ubahStatus('diterima')" style="background-color: #28a745; color: white; padding: 8px 12px; margin-right: 10px; border: none; border-radius: 6px; cursor: pointer;">Terima</button>
                    <button onclick="ubahStatus('ditolak')" style="background-color: #dc3545; color: white; padding: 8px 12px; border: none; border-radius: 6px; cursor: pointer;">Tolak</button>
                    </div>
                </div>
            </div>



        </div>
    </div>

    <!-- Scripts -->
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

    let currentPendaftarId = null;

    document.querySelectorAll('.btn-detail').forEach(function(button) {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            currentPendaftarId = id;

            fetch(`/admin/pendaftar/${id}/detail`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('modalContent').innerHTML = `
                        <p><strong>Nama:</strong> ${data.nama}</p>
                        <p><strong>Email:</strong> ${data.email}</p>
                        <p><strong>Jenis Kelamin:</strong> ${data.jenis_kelamin}</p>
                        <p><strong>Instansi:</strong> ${data.instansi}</p>
                        <p><strong>Divisi:</strong> ${data.divisi}</p>
                        <p><strong>Mulai Magang:</strong> ${data.mulai_magang}</p>
                        <p><strong>Selesai Magang:</strong> ${data.selesai_magang}</p>
                        <p><strong>CV:</strong> <a href="/storage/${data.cv}" target="_blank">Lihat CV</a></p>
                        ${data.portofolio ? `<p><strong>Portofolio:</strong> <a href="/storage/${data.portofolio}" target="_blank">Lihat</a></p>` : ''}
                        <p><strong>Status:</strong> ${data.status}</p>
                    `;
                    document.getElementById('actionButtons').style.display = 'block';
                    document.getElementById('detailModal').style.display = 'flex';
                });
        });
    });

    function closeModal() {
        document.getElementById('detailModal').style.display = 'none';
        currentPendaftarId = null;
    }

    function ubahStatus(status) {
        if (!currentPendaftarId) return;
        fetch(`/admin/update-status/${currentPendaftarId}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // untuk Laravel
            },
            body: JSON.stringify({ status })
        })
        .then(res => {
            if (!res.ok) throw new Error('Gagal update status');
            return res.json();
        })
        .then(data => {
            alert('Status berhasil diperbarui!');
            location.reload(); // Refresh agar status di halaman ikut berubah
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan saat mengubah status.');
        });
    }
</script>

</body>
</html>
