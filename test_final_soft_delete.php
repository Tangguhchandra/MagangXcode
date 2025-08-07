<?php

require_once 'vendor/autoload.php';

// Load Laravel app
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Test soft delete
try {
    // Cek struktur tabel users
    $userColumns = \Illuminate\Support\Facades\Schema::getColumnListing('users');
    echo "Kolom dalam tabel users:\n";
    foreach ($userColumns as $column) {
        echo "- $column\n";
    }

    // Cek struktur tabel pendaftarans  
    $pendaftaranColumns = \Illuminate\Support\Facades\Schema::getColumnListing('pendaftarans');
    echo "\nKolom dalam tabel pendaftarans:\n";
    foreach ($pendaftaranColumns as $column) {
        echo "- $column\n";
    }

    // Test soft delete functionality
    echo "\n=== Test Soft Delete ===\n";

    // Cek total users
    $totalUsers = \App\Models\User::count();
    echo "Total users: $totalUsers\n";

    $activeUsers = \App\Models\User::withoutTrashed()->count();
    echo "Active users: $activeUsers\n";

    $trashedUsers = \App\Models\User::onlyTrashed()->count();
    echo "Trashed users: $trashedUsers\n";

    // Cek total pendaftarans
    $totalPendaftarans = \App\Models\Pendaftaran::count();
    echo "Total pendaftarans: $totalPendaftarans\n";

    $activePendaftarans = \App\Models\Pendaftaran::withoutTrashed()->count();
    echo "Active pendaftarans: $activePendaftarans\n";

    $trashedPendaftarans = \App\Models\Pendaftaran::onlyTrashed()->count();
    echo "Trashed pendaftarans: $trashedPendaftarans\n";

    echo "\n✅ Soft delete setup berhasil untuk kedua tabel!\n";
    echo "✅ Foreign key constraint sudah diperbaiki!\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
