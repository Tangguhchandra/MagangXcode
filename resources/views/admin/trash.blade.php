@extends('layouts.admin')

@section('title', 'History Pendaftar')    

@section('content')
    <style>
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .card {
            flex: 1 1 300px;
            max-width: 400px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 10px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            background-color: #fff;
        }

        .card h2 {
            margin: 0 0 10px 0;
        }

        .card p {
            margin: 5px 0;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            margin-right: 10px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-restore {
            background-color: #28a745;
            color: white;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px 15px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px 15px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .cards-container {
                flex-direction: column;
                align-items: center;
            }

            .card {
                width: 90%;
            }
        }
    </style>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

    <div class="cards-container">
        @foreach ($pendaftarans as $pendaftaran)
            <div class="card">
                <h2>{{ $pendaftaran->nama }}</h2>
                <p><strong>Email:</strong> {{ $pendaftaran->email }}</p>
                <p><strong>Status:</strong> {{ $pendaftaran->status }}</p>
                <p><strong>Deleted At:</strong> {{ $pendaftaran->deleted_at }}</p>

                <form action="{{ route('pendaftar.restore', $pendaftaran->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-restore">Restore</button>
                </form>

                <form action="{{ route('pendaftar.permanent.delete', $pendaftaran->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus permanen data ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete">Delete Permanently</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
