<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - XCODE</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Left Section - Poster Image -->
        <div class="left-section">
            <img src="{{ asset('images/masuk.jpg') }}" alt="We Are Hiring Poster" class="poster-image">
        </div>

        <!-- Right Section - Login Form -->
        <div class="right-section">
            <div class="logo">
                <img src="{{ asset('images/logoxcode.png') }}" alt="Logo XCODE" style="width: 100px;">
            </div>

            <div class="form-container">
                <h2 class="form-title">Masuk</h2>
                <p class="form-subtitle">Silakan masuk untuk melanjutkan.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <input type="email" class="form-input" id="email" name="email" placeholder="e-Mail" required>
                    </div>

                    <div class="form-group password-group">
                        <input type="password" class="form-input" id="password" name="password" placeholder="Password" required>
                        <span class="password-toggle" onclick="togglePassword('password')">
                            <i class="fa-solid fa-eye"></i>
                        </span>
                    </div>

                    @if ($errors->any())
                        <div style="color: red; font-size: 14px; margin-bottom: 10px;">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <button type="submit" class="submit-btn">Masuk</button>
                </form>

                <div class="signin-link">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Toggle password visibility
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const toggle = input.nextElementSibling;
        const icon = toggle.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Border effect
    document.querySelectorAll('.form-input').forEach(input => {
        input.addEventListener('focus', function () {
            input.style.borderColor = '#dc3545';
        });

        input.addEventListener('blur', function () {
            input.style.borderColor = '#e0e0e0';
        });
    });
    </script>
</body>
</html>