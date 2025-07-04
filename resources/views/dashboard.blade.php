<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pemagang</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <h1>Selamat datang, {{ Auth::user()->name }}</h1>
        <p>Ini adalah dashboard kamu sebagai calon pemagang.</p>

        <ul>
            <li>Status pendaftaran: <strong>Belum diverifikasi</strong></li>
            <li>Tanggal daftar: {{ Auth::user()->created_at->format('d-m-Y') }}</li>
        </ul>

        <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
