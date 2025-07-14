@extends('layouts.app')

@section('content')
<!-- Heroicons + AOS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        AOS.init();
    });
</script>

<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-2xl shadow-2xl" data-aos="fade-up" data-aos-duration="1000">

    <!-- PROFILE HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3b82f6&color=fff&rounded=true&size=100"
             alt="Foto Profil"
             class="w-24 h-24 rounded-full border-4 border-blue-500 shadow-md transition-transform hover:scale-105">

        <div class="mt-4 sm:mt-0">
            <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
            <p class="text-gray-500 flex items-center">
                <svg class="w-5 h-5 text-gray-400 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 12a4 4 0 01-8 0m8 0a4 4 0 01-8 0m8 0V9a4 4 0 00-8 0v3m8 0v3a4 4 0 01-8 0v-3"/>
                </svg>
                {{ $user->email }}
            </p>
        </div>
    </div>

    <div class="my-6 border-t border-gray-200"></div>

    <!-- STATUS PENDAFTARAN -->
    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
        <svg class="w-6 h-6 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7"/>
        </svg>
        Status Pendaftaran Magang
    </h3>

    @if ($pendaftaran->count())
    @foreach ($pendaftaran as $daftar)
        @php
            $statusColor = match($daftar->status) {
                'pending' => 'bg-yellow-100 text-yellow-800',
                'diterima' => 'bg-green-100 text-green-800',
                'ditolak' => 'bg-red-100 text-red-800',
                default => 'bg-gray-100 text-gray-800',
            };
        @endphp

        <div class="mb-6 p-4 rounded-xl shadow-lg border border-gray-200" data-aos="fade-up" data-aos-delay="200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                <div><strong>Nama:</strong> {{ $daftar->nama }}</div>
                <div><strong>Instansi:</strong> {{ $daftar->instansi }}</div>
                <div><strong>Divisi:</strong> {{ $daftar->divisi }}</div>
                <div>
                    <strong>Status:</strong>
                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statusColor }}">
                        {{ ucfirst($daftar->status) }}
                    </span> 
                </div>
                <div>
                    <strong>CV:</strong>
                    <a href="{{ asset('storage/' . $daftar->cv) }}" target="_blank"
                       class="text-blue-600 underline hover:text-blue-800 transition-all duration-200">
                        📄 Lihat CV
                    </a>
                </div>

                @if ($daftar->portofolio)
                    <div>
                        <strong>Portofolio:</strong>
                        <a href="{{ asset('storage/' . $daftar->portofolio) }}" target="_blank"
                           class="text-blue-600 underline hover:text-blue-800 transition-all duration-200">
                            🧾 Lihat Portofolio
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
@else
    <div class="text-gray-500 italic" data-aos="fade-up">
        Kamu belum melakukan pendaftaran magang.
    </div>
@endif

</div>
@endsection
