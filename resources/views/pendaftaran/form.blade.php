<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <style>
        /* Tambahan animasi dan efek */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulseBorder {
            0% {
                box-shadow: 0 0 0 0 rgba(230, 57, 70, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(230, 57, 70, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(230, 57, 70, 0);
            }
        }

        body {
            animation: fadeInUp 1s ease;
        }

        .form-container {
            animation: fadeInUp 1.2s ease-in-out;
            backdrop-filter: blur(10px);
            background: white;
        }

        .btn-submit {
            animation: pulseBorder 2s infinite;
        }

        .form-group input:focus,
        .form-group select:focus {
            animation: pulseBorder 1.5s ease;
        }

        .form-group {
            transition: transform 0.3s;
        }

        .form-group:hover {
            transform: scale(1.01);
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Formulir Pendaftaran Magang</h1>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <h4>Terdapat kesalahan pada form:</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama', auth()->user()->name) }}" readonly class="readonly">
                <span class="error-text">Pastikan nama lengkap Anda benar</span>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" readonly class="readonly">
                <span class="error-text">Pastikan alamat email benar</span>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="instansi">Instansi</label>
                <input type="text" id="instansi" name="instansi" value="{{ old('instansi') }}" required>
                @error('instansi')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="divisi">Divisi</label>
                <select name="divisi" id="divisi" required>
                    <option value="">-- Pilih Divisi --</option>
                    <option value="Cyber Security Consultant" {{ old('divisi') == 'Cyber Security Consultant' ? 'selected' : '' }}>Cyber Security Consultant</option>
                    <option value="Programmer (Front End / Back end)" {{ old('divisi') == 'Programmer (Front End / Back end)' ? 'selected' : '' }}>Programmer (Front End / Back end)</option>
                    <option value="Public Relation" {{ old('divisi') == 'Public Relation' ? 'selected' : '' }}>Public Relation</option>
                    <option value="Designer" {{ old('divisi') == 'Designer' ? 'selected' : '' }}>Designer</option>
                    <option value="IT Network & Hardware" {{ old('divisi') == 'IT Network & Hardware' ? 'selected' : '' }}>IT Network & Hardware</option>
                    <option value="Network Engineer" {{ old('divisi') == 'Network Engineer' ? 'selected' : '' }}>Network Engineer</option>
                </select>
                @error('divisi')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="mulai_magang">Mulai Magang</label>
                <input type="date" id="mulai_magang" name="mulai_magang" value="{{ old('mulai_magang') }}" required>
                @error('mulai_magang')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="selesai_magang">Selesai Magang</label>
                <input type="date" id="selesai_magang" name="selesai_magang" value="{{ old('selesai_magang') }}" required>
                @error('selesai_magang')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="foto">Foto Profesional</label>
                <input type="file" name="foto" id="foto" accept="image/*" required>
                <small class="file-info">Format: JPG, PNG (Max: 2MB)</small>
                @error('foto')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="cv">CV (PDF)</label>
                <input type="file" name="cv" id="cv" accept="application/pdf" required>
                <small class="file-info">Format: PDF (Max: 2MB)</small>
                @error('cv')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="portofolio">Portofolio (Opsional)</label>
                <input type="file" name="portofolio" id="portofolio" accept=".pdf,.docx,.pptx">
                <small class="file-info">Format: PDF, DOCX, PPTX (Max: 4MB)</small>
                @error('portofolio')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Kirim Pendaftaran</button>
                
            </div>

        </form>

    </div>

    <a href="{{ route('user.dashboard') }}" class="btn-back">
    Kembali ke Beranda
    </a>

</body>

</html>
