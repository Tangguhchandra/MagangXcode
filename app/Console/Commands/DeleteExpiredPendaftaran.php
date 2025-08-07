<?php

namespace App\Console\Commands;

use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredPendaftaran extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-expired-pendaftaran';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete pendaftaran yang sudah dihapus lebih dari 30 hari secara permanen';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cutOffdate = Carbon::now()->subDays(30);

        $expiredPendaftaransTrash = Pendaftaran::onlyTrashed()
            ->where('deleted_at', '<=', $cutOffdate)
            ->get();
        $count = $expiredPendaftaransTrash->count();

        foreach ($expiredPendaftaransTrash as $pendaftaran) {
            $pendaftaran->forceDelete();
        }

        if ($count > 0) {
            $this->info("Berhasil menghapus $count pendaftaran yang sudah dihapus lebih dari 30 hari.");
        } else {
            $this->info("Tidak ada pendaftaran yang sudah dihapus lebih dari 30 hari.");
        }
    }
}
