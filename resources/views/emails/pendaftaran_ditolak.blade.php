<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Ditolak</title>
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
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
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
            border-left: 4px solid #dc3545;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            color: #6c757d;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Pemberitahuan Pendaftaran Magang</h1>
    </div>

    <div class="content">
        <p>Halo <strong>{{ $pendaftar->nama }}</strong>,</p>

        <p>Terima kasih atas minat Anda untuk bergabung dalam program magang di perusahaan kami. Setelah melakukan
            evaluasi terhadap pendaftaran Anda, dengan berat hati kami informasikan bahwa pendaftaran magang Anda belum
            dapat kami terima untuk saat ini.</p>

        <div class="info-box">
            <h3>Detail Pendaftaran:</h3>
            <ul>
                <li><strong>Nama:</strong> {{ $pendaftar->nama }}</li>
                <li><strong>Email:</strong> {{ $pendaftar->email }}</li>
                <li><strong>Instansi:</strong> {{ $pendaftar->instansi }}</li>
                <li><strong>Divisi:</strong> {{ $pendaftar->divisi }}</li>
            </ul>
        </div>

        <p>Keputusan ini diambil berdasarkan berbagai pertimbangan, termasuk kapasitas dan kebutuhan tim kami saat ini.
            Kami mendorong Anda untuk tetap mengembangkan keterampilan dan pengalaman Anda, serta tidak ragu untuk
            mencoba kesempatan lain di masa mendatang.</p>

        <p>Kami menghargai waktu dan usaha yang telah Anda berikan dalam proses pendaftaran ini.</p>
    </div>

    <div class="footer">
        <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
        <p><strong>Tim HRD XCode</strong></p>
    </div>
</body>

</html>
