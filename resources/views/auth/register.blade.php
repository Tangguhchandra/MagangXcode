<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - PKL</title>
    <style>
        body {
            background: #f4f6f8;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 350px;
        }
        .card h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input {
            width: 100%;
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
    <div class="card">
        <h2>Daftar Akun PKL</h2>

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
