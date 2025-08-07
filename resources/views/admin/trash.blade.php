<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>trash</title>
</head>
<body>
    @foreach ($pendaftarans as $pendaftaran)
        <div>
            <h2>{{ $pendaftaran->nama }}</h2>
            <p>Email: {{ $pendaftaran->email }}</p>
            <p>Status: {{ $pendaftaran->status }}</p>
            <p>Deleted At: {{ $pendaftaran->deleted_at }}</p>
            <form action="{{ route('pendaftar.restore', $pendaftaran->id) }}" method="POST">
                @csrf
                @method('POST')
                <button type="submit">Restore</button>
            </form>
            <form action="{{ route('pendaftar.permanent.delete', $pendaftaran->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete Permanently</button>
            </form>
        </div>
        
    @endforeach
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
                <th>Deleted At</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        </tbody>
    </table>
</body>
</html>