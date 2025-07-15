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
                    <h2 class="profile-name">{{ $user->name }}</h2>
                    <p class="profile-role">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Right Section - Bio & Details -->
            @if ($pendaftaran->count() > 0)
                <div class="bio-card" data-aos="fade-up">
                    @foreach ($pendaftaran as $daftar)
                        <div class="bio-header">
                            <h3>Informasi saya</h3>
                            <div class="status-indicator">
                                <span class="status-dot active"></span>
                            </div>
                        </div>

                        <div class="bio-content">
                            <div class="bio-grid">
                                <div class="bio-item">
                                    <label>Divisi</label>
                                    <p>{{ $daftar->divisi ?? 'Member' }}</p>
                                </div>
                                <div class="bio-item">
                                    <label>Email</label>
                                    <p>{{ $user->email }}</p>
                                </div>
                                <div class="bio-item">
                                    <label>Status</label>
                                    <p>
                                        <span>
                                            @php
                                                $statusClass = match ($daftar->status) {
                                                    'pending' => 'badge badge-warning',
                                                    'diterima' => 'badge badge-success',
                                                    'ditolak' => 'badge badge-danger',
                                                    default => 'badge',
                                                };
                                            @endphp
                                            <span class="{{ $statusClass }}">{{ ucfirst($daftar->status) }}</span>
                                        </span>
                                    </p>
                                </div>
                                <div class="bio-item">
                                    <label>Member sejak</label>
                                    <p>{{ $user->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="bio-item">
                                    <label>Terakhir Diperbarui</label>
                                    <p>{{ $user->updated_at->diffForHumans() }}</p>
                                </div>
                                {{-- <div class="bio-item">
                                    <label>Account Status</label>
                                    <p class="availability">
                                        <span class="status-dot active"></span>
                                        Active Member
                                    </p>
                                </div> --}}

                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
        @endif
    </div>


@endsection
