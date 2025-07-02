<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - PKL</title>
    <style>
        body {
            background: url('{{ asset('images/bgxcode3.png') }}') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5); /* Transparansi hitam */
            z-index: 0;
        }
        .logo {
            position: absolute;
            top: 20px;
            left: 30px;
            z-index: 2;
            background-color: white;       /* Background putih */
            padding: 6px 12px;              /* Ruang dalam */
            border-radius: 8px;             /* Sudut membulat */
            box-shadow: 0 2px 8px rgba(0,0,0,0.15); /* Efek bayangan */
        }

        .logo img {
            height: 100px;
            object-fit: contain;
            display: block;
        }


        .card {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 350px;
            position: relative;
            z-index: 1;
        }
        .card h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #0066cc;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .link {
            margin-top: 10px;
            text-align: center;
            font-size: 14px;
        }
        .link a {
            color: #0066cc;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="/images/logoxcode.png" alt="Logo XCODE">
    </div>

    <div class="card">
        <h2>Daftar Akun Magang</h2>

    {{-- ERROR VALIDATION --}}
    @if ($errors->any())
        <div style="color:red; margin-bottom:10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form method="POST" action="/register">
            @csrf
            <input type="text" name="name" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Daftar</button>
        </form>
        <div class="link">
            Sudah punya akun? <a href="/login">Login</a>
        </div>
    </div>
</body>
</html>
