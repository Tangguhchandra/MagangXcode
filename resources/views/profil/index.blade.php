@extends('layouts.app')

@section('content')
    <!-- Heroicons + AOS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('css/profil.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init();
        });
    </script>
    <div class="profile-container">
        <!-- Profile Header Section -->
        <div class="profile-header">
            <div class="profile-title">
                <h1>Profil</h1>
                <p>Lihat detail Informasi pemagang</p>
            </div>
            <div class="header-status">
                <span class="status-dot active"></span>
            </div>
        </div>

        <!-- Main Profile Content -->
        <div class="profile-content">
            <!-- Left Section - Profile Info -->
            <div class="profile-card">
                <div class="profile-info">
                    <div class="profile-avatar">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3b82f6&color=fff&rounded=true&size=200"
                            alt="Profile Picture">
                    </div>
                    <h2 class="profile-name">{{ $user->name ? $user->name : 'Member' }}</h2>
                    <p class="profile-role">{{ $user->email ? $user->email : 'example@gmail.com' }}</p>
                    <!-- Add badges based on user status -->

                </div>
            </div>

            <!-- Right Section - Bio & Details -->
            <div class="bio-card" data-aos="fade-up">
                <div class="bio-header">
                    <h3>Informasi saya</h3>
                    <div class="status-indicator">
                        <span class="status-dot active"></span>
                    </div>
                </div>
                <div class="bio-content">
                    @if ($pendaftaran->count() > 0)
                        <!-- User has registrations -->
                        @foreach ($pendaftaran as $index => $daftar)
                            @if ($index == 0)
                                <!-- Show only the latest registration -->
                                <div class="bio-grid">
                                    <div class="bio-item">
                                        <label>Nama Lengkap</label>
                                        <p>{{ $user->name ?? 'Belum diisi' }}</p>
                                    </div>
                                    <div class="bio-item">
                                        <label>Email</label>
                                        <p>{{ $user->email }}</p>
                                    </div>
                                    <div class="bio-item">
                                        <label>Instansi</label>
                                        <p>{{ $daftar->instansi ?? 'Belum diisi' }}</p>
                                    </div>
                                    <div class="bio-item">
                                        <label>Divisi</label>
                                        <p>{{ $daftar->divisi ?? 'Belum diisi' }}</p>
                                    </div>
                                    <div class="bio-item">
                                        <label>Status Pendaftaran</label>
                                        <p>
                                            @php
                                                $statusClass = match ($daftar->status) {
                                                    'pending' => 'badge badge-warning',
                                                    'diterima' => 'badge badge-success',
                                                    'ditolak' => 'badge badge-danger',
                                                    default => 'badge',
                                                };
                                            @endphp
                                            <span class="{{ $statusClass }}">{{ ucfirst($daftar->status) }}</span>
                                        </p>
                                    </div>
                                    <div class="bio-item">
                                        <label>Tanggal Daftar</label>
                                        <p>{{ $daftar->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div class="bio-item">
                                        <label>Member sejak</label>
                                        <p>{{ $user->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div class="bio-item">
                                        <label>Mulai magang</label>
                                        <p>{{ $daftar->mulai_magang}}</p>
                                    </div>
                                    <div class="bio-item">
                                        <label>Selesai magang</label>
                                        <p>{{ $daftar->selesai_magang}}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <!-- User has no registrations -->
                        <div class="bio-grid">
                            <div class="bio-item">
                                <label>Nama Lengkap</label>
                                <p>{{ $user->name ?? 'Belum diisi' }}</p>
                            </div>
                            <div class="bio-item">
                                <label>Email</label>
                                <p>{{ $user->email }}</p>
                            </div>
                            <div class="bio-item">
                                <label>Instansi</label>
                                <p class="text-muted">Belum ada pendaftaran</p>
                            </div>
                            <div class="bio-item">
                                <label>Divisi</label>
                                <p class="text-muted">Belum ada pendaftaran</p>
                            </div>
                            <div class="bio-item">
                                <label>Status Pendaftaran</label>
                                <p>
                                    <span class="badge badge-info">Belum Mendaftar</span>
                                </p>
                            </div>
                            <div class="bio-item">
                                <label>Member sejak</label>
                                <p>{{ $user->created_at->format('d M Y') }}</p>
                            </div>
                            <div class="bio-item">
                                <label>Mulai magang</label>
                                <p class="text-muted">Belum ada pendaftaran</p>
                            </div>
                            <div class="bio-item">
                                <label>Selesai magang</label>
                                <p class="text-muted">Belum ada pendaftaran</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
