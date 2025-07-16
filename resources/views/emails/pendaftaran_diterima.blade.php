<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Diterima</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
            border: 1px solid #e9ecef;
        }

        .info-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #28a745;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            color: #6c757d;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            background: #28a745;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            margin: 15px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>🎉 Selamat!</h1>
        <h2>Pendaftaran Magang Anda Diterima</h2>
    </div>

    <div class="content">
        <p>Halo <strong>{{ $pendaftar->nama }}</strong>,</p>

        <p>Kami dengan senang hati memberitahukan bahwa pendaftaran magang Anda telah <strong>DITERIMA</strong>!</p>

        <div class="info-box">
            <h3>Detail Pendaftaran:</h3>
            <ul>
                <li><strong>Nama:</strong> {{ $pendaftar->nama }}</li>
                <li><strong>Email:</strong> {{ $pendaftar->email }}</li>
                <li><strong>Instansi:</strong> {{ $pendaftar->instansi }}</li>
                <li><strong>Divisi:</strong> {{ $pendaftar->divisi }}</li>
                <li><strong>Mulai Magang:</strong>
                    {{ \Carbon\Carbon::parse($pendaftar->mulai_magang)->format('d F Y') }}</li>
                <li><strong>Selesai Magang:</strong>
                    {{ \Carbon\Carbon::parse($pendaftar->selesai_magang)->format('d F Y') }}</li>
            </ul>
        </div>

        <p>Silakan hubungi kami untuk informasi lebih lanjut mengenai jadwal dan persiapan magang.</p>

        <p style="text-align: center;">
            <a href="{{ url('/dashboard') }}" class="btn">Login ke Dashboard</a>
        </p>

        <p>Terima kasih atas minat Anda untuk bergabung dengan kami. Kami berharap Anda akan mendapatkan pengalaman
            berharga selama magang di perusahaan kami.</p>
    </div>

    <div class="footer">
        <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
        <p><strong>Tim HRD XCode</strong></p>
    </div>
</body>

</html>
