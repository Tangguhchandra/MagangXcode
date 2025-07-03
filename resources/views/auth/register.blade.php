<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>DAFTAR MAGANG</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login-left">
            <h2>SIGN IN</h2>

            @if ($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf

                <label for="name">Nama</label>
                <input type="name" name="name" placeholder="Masukkan nama anda" required>

                <label for="email">Email</label>
                <input type="email" name="email" placeholder="example@gmail.com" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Masukkan password Anda" required>

                <button type="submit">KIRIM</button>

                <p class="login-link">
                    Sudah punya akun?
                    <a href="{{ url('/login') }}">Masuk di sini</a>
                </p>
            </form>
        </div>

        <!-- Tambahkan ini -->
        <div class="login-right"></div>
    </div>
</body>
</html>
