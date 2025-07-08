<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - XCODE</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Left Section - Poster Image -->
        <div class="left-section">
            <img src="{{ asset('images/daftar.jpg') }}" alt="We Are Hiring Poster" class="poster-image">
        </div>

        <!-- Right Section - Registration Form -->
        <div class="right-section">
            <div class="logo">
                <img src="{{ asset('images/logoxcode.png') }}" alt="Logo XCODE" style="width: 100px;">
            </div>

            <div class="form-container">
                <h2 class="form-title">Daftar</h2>
                <p class="form-subtitle">Silakan daftar akun untuk melanjutkan.</p>

                <form id="registrationForm" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <input type="text" class="form-input" id="fullName" name="name" placeholder="Nama Lengkap" required>
                    </div>

                    <div class="form-group"> 
                        <input type="email" class="form-input" id="email" name="email" placeholder="e-Mail" required>
                        <small style="color: red; display: block; margin-top: 5px;">Gunakan email resmi!</small>
                    </div>


                    <div class="form-group password-group">
                        <input type="password" class="form-input" id="password" name="password" placeholder="Password" required>
                        <span class="password-toggle" onclick="togglePassword('password')">
                            <i class="fa-solid fa-eye"></i>
                        </span>
                    </div>

                    <div class="form-group password-group">
                        <input type="password" class="form-input" id="confirmPassword" name="password_confirmation" placeholder="Konfirmasi Password" required>
                        <span class="password-toggle" onclick="togglePassword('confirmPassword')">
                            <i class="fa-solid fa-eye"></i>
                        </span>
                    </div>

                    <small id="passwordMismatchError" style="color: red; display: none;">
                        Password dan konfirmasi password tidak cocok.
                    </small>

                    <button type="submit" class="submit-btn">Daftar</button>
                </form>


                <div class="signin-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk.</a>
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

    // Border effect & floating label
    document.querySelectorAll('.form-input').forEach(input => {
        const label = input.nextElementSibling;

        input.addEventListener('focus', function () {
            input.style.borderColor = '#dc3545';
            if (label && label.classList.contains('form-label-floating')) {
                label.style.opacity = '1';
            }
        });

        input.addEventListener('blur', function () {
            input.style.borderColor = '#e0e0e0';
            if (label && label.classList.contains('form-label-floating')) {
                label.style.opacity = '0';
            }
        });
    });

    // Validasi form saat submit
    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        const errorMsg = document.getElementById('passwordMismatchError');

        // Reset error
        errorMsg.style.display = 'none';
        confirmPassword.classList.remove('error');

        if (
            confirmPassword.value !== '' &&
            password.value !== confirmPassword.value
        ) {
            e.preventDefault(); // ❗MENCEGAH FORM TERKIRIM
            errorMsg.style.display = 'block';
            confirmPassword.classList.add('error');
        }
    });
</script>
</body>
</html>