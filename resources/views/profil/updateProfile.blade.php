@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/profil.css') }}" rel="stylesheet">

    <div class="update-container">
        <!-- Profile Header -->
        <div class="update-header">
            <div class="profile-title">
                <h1>Update Profil</h1>
                <p>Perbarui informasi pemagang Anda</p>
            </div>
        </div>

        <!-- Main Content (Hanya Form Saja) -->
        <div class="update-content">
            <div class="form-card" data-aos="fade-up">
                <div class="bio-header">
                    <h3>Formulir Update</h3>
                </div>

                <form action="{{ route('pendaftar.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="bio-grid">
                        <!-- Nama -->
                        <div class="bio-item">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('name', Auth::user()->name) }}">
                            @error('nama')
                                <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="bio-item">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', Auth::user()->email) }}">
                            @error('email')
                                <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mulai Magang -->
                        <div class="bio-item">
                            <label for="mulai_magang">Mulai Magang</label>
                            <input type="date" id="mulai_magang" name="mulai_magang"
                                class="form-control @error('mulai_magang') is-invalid @enderror"
                                value="{{ old('mulai_magang', $pendaftaran->mulai_magang) }}">
                            @error('mulai_magang')
                                <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Selesai Magang -->
                        <div class="bio-item">
                            <label for="selesai_magang">Selesai Magang</label>
                            <input type="date" id="selesai_magang" name="selesai_magang"
                                class="form-control @error('selesai_magang') is-invalid @enderror"
                                value="{{ old('selesai_magang', $pendaftaran->selesai_magang) }}">
                            @error('selesai_magang')
                                <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="action-buttons" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
