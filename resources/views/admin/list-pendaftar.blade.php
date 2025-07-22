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
                    <form id="searchForm" action="{{ route('admin.pendaftar') }}" method="GET">
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

            <!-- CARD -->
            <div class="card-container" style="max-height: 90vh; overflow-y: auto; margin-top: 10px;">

                @foreach ($pendaftar as $item)
                
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

            <!-- Modal -->
    <!-- Modal -->
    <div id="detailModal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Detail Pendaftar</h3>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>
            
            <div class="modal-body">
                <div id="modalContent">
                    <div class="detail-item">
                        <div class="detail-label">Nama:</div>
                        <div class="detail-value">bambang</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Email:</div>
                        <div class="detail-value">bambang@gmail.com</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Jenis Kelamin:</div>
                        <div class="detail-value">Laki-laki</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Instansi:</div>
                        <div class="detail-value">SMK TELKOM PURWOKERTO</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Divisi:</div>
                        <div class="detail-value">Cyber Security Consultant</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Mulai Magang:</div>
                        <div class="detail-value">2025-02-23</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Selesai Magang:</div>
                        <div class="detail-value">2025-12-31</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">CV:</div>
                        <div class="detail-value">
                            <a href="#" class="cv-link">Lihat CV</a>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Status:</div>
                        <div class="detail-value">
                            <span class="status-badge status-diterima">diterima</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer" id="actionButtons">
                <button class="btn btn-success" onclick="ubahStatus('diterima')">
                    Terima
                </button>
                <button class="btn btn-danger" onclick="ubahStatus('ditolak')">
                    Tolak
                </button>
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
 // Generate content dengan struktur yang rapi
 let contentHTML = `
 <div class="detail-item">
 <div class="detail-label">Nama:</div>
 <div class="detail-value">${data.nama}</div>
 </div>
 
 <div class="detail-item">
 <div class="detail-label">Email:</div>
 <div class="detail-value">${data.email}</div>
 </div>
 
 <div class="detail-item">
 <div class="detail-label">Jenis Kelamin:</div>
 <div class="detail-value">${data.jenis_kelamin}</div>
 </div>
 
 <div class="detail-item">
 <div class="detail-label">Instansi:</div>
 <div class="detail-value">${data.instansi}</div>
 </div>
 
 <div class="detail-item">
 <div class="detail-label">Divisi:</div>
 <div class="detail-value">${data.divisi}</div>
 </div>
 
 <div class="detail-item">
 <div class="detail-label">Mulai Magang:</div>
 <div class="detail-value">${data.mulai_magang}</div>
 </div>
 
 <div class="detail-item">
 <div class="detail-label">Selesai Magang:</div>
 <div class="detail-value">${data.selesai_magang}</div>
 </div>
 
 <div class="detail-item">
 <div class="detail-label">CV:</div>
 <div class="detail-value">
 <a href="/storage/${data.cv}" target="_blank" class="cv-link">Lihat CV</a>
 </div>
 </div>`;

 // Tambahkan portofolio jika ada
 if (data.portofolio) {
 contentHTML += `
 <div class="detail-item">
 <div class="detail-label">Portofolio:</div>
 <div class="detail-value">
 <a href="/storage/${data.portofolio}" target="_blank" class="cv-link">Lihat</a>
 </div>
 </div>`;
 }

 // Tambahkan status dengan badge styling
 const statusClass = getStatusClass(data.status);
 contentHTML += `
 <div class="detail-item">
 <div class="detail-label">Status:</div>
 <div class="detail-value">
 <span class="status-badge ${statusClass}">${data.status}</span>
 </div>
 </div>`;

 document.getElementById('modalContent').innerHTML = contentHTML;
 document.getElementById('actionButtons').style.display = 'block';
 document.getElementById('detailModal').style.display = 'flex';
 document.body.style.overflow = 'hidden';
 });
 });
 });

function getStatusClass(status) {
 switch(status.toLowerCase()) {
 case 'diterima':
 return 'status-diterima';
 case 'ditolak':
 return 'status-ditolak';
 default:
 return 'status-pending';
 }
}

function closeModal() {
 document.getElementById('detailModal').style.display = 'none';
 document.body.style.overflow = 'auto';
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
 // Update status badge di modal
 const statusElement = document.querySelector('.status-badge');
 if (statusElement) {
 statusElement.textContent = status;
 statusElement.className = `status-badge ${getStatusClass(status)}`;
 }
 
alert('Status berhasil diperbarui!');
 location.reload(); // Refresh agar status di halaman ikut berubah
 })
 .catch(err => {
 console.error(err);
alert('Terjadi kesalahan saat mengubah status.');
 });
 }

// Close modal when clicking outside
window.onclick = function(event) {
 const modal = document.getElementById('detailModal');
 if (event.target === modal) {
 closeModal();
 }
}

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
 if (event.key === 'Escape') {
 closeModal();
 }
});

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
