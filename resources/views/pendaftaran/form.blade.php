<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"> <!-- CSS terhubung di sini -->
</head>
<body>
    <div class="form-container">
        <h1>Formulir Pendaftaran Magang</h1>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" required>

            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <label for="instansi">Instansi</label>
            <input type="text" id="instansi" name="instansi" required>

            <label for="divisi">Divisi</label>
            <input type="text" id="divisi" name="divisi" required>

            <label for="foto">Foto Profesional</label>
            <input type="file" name="foto" id="foto" accept="image/*" required>

            <label for="cv">CV (PDF)</label>
            <input type="file" name="cv" id="cv" accept="application/pdf" required>

            <label for="portofolio">Portofolio (Opsional)</label>
            <input type="file" name="portofolio" id="portofolio" accept=".pdf,.docx,.pptx">

            <button type="submit">Kirim Pendaftaran</button>
        </form>
    </div>
</body>
</html>
