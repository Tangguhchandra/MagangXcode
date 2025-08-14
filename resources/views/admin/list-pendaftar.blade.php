@extends('layouts.admin')
@section('title', 'List Pendaftar')
@section('content')
            <div class="card-container" style="max-height: 90vh; overflow-y: auto; margin-top: 10px;">
                @foreach ($pendaftar as $item)
                    <div class="pendaftar-card" style="position: relative;">

                        <!-- Tombol Delete Icon -->
                        <form action="{{ route('pendaftar.destroy', $item->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                            style="position: absolute; top: 10px; right: 10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: transparent; border: none; cursor: pointer;">
                                <i class="fas fa-trash" style="color: #9d0000; font-size: 18px;"></i>
                            </button>
                        </form>

                        <!-- Isi Card -->
                        <h3>{{ $item->nama }}</h3>
                        <p><strong>Instansi:</strong> {{ $item->instansi }}</p>
                        <p><strong>Email:</strong> {{ $item->email }}</p>
                        <p><strong>Status:</strong>
                            <span class="status {{ $item->status ?? 'pending' }}">
                                {{ ucfirst($item->status ?? 'pending') }}
                            </span>
                        </p>
                        <button type="button" class="btn-detail" data-id="{{ $item->id }}">
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
        let currentPendaftarId = null;
        document.querySelectorAll('.btn-detail').forEach(function(button) {
            button.addEventListener('click', function() {
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
    <div class="detail-label">Foto:</div>
    <div class="detail-value">
        ${
            data.foto
                ? `<a href="/storage/${encodeURIComponent(data.foto)}" target="_blank" class="cv-link">Lihat Foto</a>`
                : '-'
        }
    </div>
</div>

 <div class="detail-item">
 <div class="detail-label">CV:</div>
 <div class="detail-value">
<a href="/storage/${encodeURIComponent(data.cv)}" target="_blank" class="cv-link">Lihat CV</a>
 </div>
 </div>`;


                        contentHTML += `
<div class="detail-item">
  <div class="detail-label">Portofolio:</div>
  <div class="detail-value">
    ${
      data.portofolio
        ? `<a href="/storage/${encodeURIComponent(data.portofolio)}" target="_blank" class="cv-link">Lihat CV</a>`
        : '-'
    }
  </div>
</div>`;


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
            switch (status.toLowerCase()) {
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

        function showLoading() {
            const popup = document.getElementById('loadingPopup');
            if (popup) {
                popup.style.display = 'flex'; // atau 'block', tergantung CSS kamu
            }
        }

        function hideLoading() {
            const popup = document.getElementById('loadingPopup');
            if (popup) {
                popup.style.display = 'none';
            }
        }


        function ubahStatus(status) {
            if (!currentPendaftarId) return;

            showLoading(); // Tampilkan popup loading

            fetch(`/admin/update-status/${currentPendaftarId}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status
                    })
                })
                .then(res => {
                    if (!res.ok) throw new Error('Gagal update status');
                    return res.json(); // cukup 1x json()
                })
                .then(data => {

                    location.reload(); // Reload halaman tanpa alert
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

    </script>

    <!-- Popup Loading -->
    <div id="loadingPopup">
        <div class="popup-box">
            <div class="spinner"></div>
            <p>Mengubah status...</p>
        </div>
    </div>
@endsection
