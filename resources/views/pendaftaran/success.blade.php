<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pendaftaran Berhasil</title>
  <meta http-equiv="refresh" content="3;url=/dashboard">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      height: 100vh;
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      background: url('images/4.jpeg') no-repeat center center fixed;
      background-size: cover;
      position: relative;
      padding: 20px;
    }

    body::before {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      z-index: 0;
    }

    .card {
      position: relative;
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(15px);
      border-radius: 20px;
      padding: 40px 30px;
      box-shadow: 0 0 30px rgba(255, 0, 0, 0.2);
      text-align: center;
      width: 100%;
      max-width: 420px;
      z-index: 1;
      color: #fff;
      animation: fadeInUp 0.8s ease;
    }

    h2 {
      font-size: 26px;
      color: #ff4b4b;
      margin-bottom: 16px;
      font-weight: 600;
    }

    p {
      font-size: 15px;
      color: #e0e0e0;
      margin-bottom: 12px;
    }

    .loader {
      margin: 20px auto 0;
      border: 3px solid rgba(255, 255, 255, 0.2);
      border-top: 3px solid #ff4b4b;
      border-radius: 50%;
      width: 32px;
      height: 32px;
      animation: spin 1s linear infinite;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    @media (max-width: 480px) {
      .card {
        padding: 30px 20px;
      }

      h2 {
        font-size: 22px;
      }

      p {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>✅ Pendaftaran Berhasil</h2>
    <p>Selamat! Akun kamu telah terdaftar.</p>
    <p>Konfirmasi akan dikirim ke email kamu.</p>
    <p>Mengarahkan ke dashboard...</p>
    <div class="loader"></div>
  </div>
</body>
</html>
