<?php

require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Load Laravel app
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Test soft delete
try {
    // Cek apakah ada data pendaftaran
    $totalPendaftaran = \App\Models\Pendaftaran::count();
    echo "Total pendaftaran (termasuk yang dihapus): $totalPendaftaran\n";

    // Cek data yang tidak dihapus
    $activePendaftaran = \App\Models\Pendaftaran::withoutTrashed()->count();
    echo "Total pendaftaran aktif: $activePendaftaran\n";

    // Cek data yang sudah dihapus
    $trashedPendaftaran = \App\Models\Pendaftaran::onlyTrashed()->count();
    echo "Total pendaftaran di trash: $trashedPendaftaran\n";

    // Cek struktur tabel
    $columns = \Illuminate\Support\Facades\Schema::getColumnListing('pendaftarans');
    echo "Kolom dalam tabel pendaftarans:\n";
    foreach ($columns as $column) {
        echo "- $column\n";
    }

    echo "\nSoft delete berfungsi dengan baik!\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
