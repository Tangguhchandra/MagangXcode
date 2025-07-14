<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Models\Pendaftaran;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.dashboardsec';

    // Tambahkan label navigasi agar tidak error
    protected static ?string $navigationLabel = 'Dashboard Admin';

    // Custom title untuk admin dashboard
    protected static ?string $title = 'Dashboard Admin';

    // Add custom route name to avoid conflicts
    protected static ?string $slug = 'admin-dashboard';

    public $total;
    public $diterima;
    public $pending;
    public $ditolak;
    public $persentase;
    public $recent;

    public function mount(): void
    {
        $this->total = Pendaftaran::count();
        $this->diterima = Pendaftaran::where('status', 'diterima')->count();
        $this->pending = Pendaftaran::where('status', 'pending')->count();
        $this->ditolak = Pendaftaran::where('status', 'ditolak')->count();
        $this->persentase = $this->total > 0 ? round(($this->diterima / $this->total) * 100, 2) : 0;
        $this->recent = Pendaftaran::latest()->take(5)->get();
    }
}
