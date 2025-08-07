<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-expired-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete users yang sudah dihapus lebih dari 30 hari secara permanen';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cutOffDate = Carbon::now()->subDays(30);

        $expiredUsers = User::onlyTrashed()
            ->where('deleted_at', '<=', $cutOffDate)
            ->get();
        $count = $expiredUsers->count();

        foreach ($expiredUsers as $user) {
            // Hapus semua pendaftaran yang terkait secara permanen
            $user->pendaftaran()->forceDelete();

            // Hapus user secara permanen
            $user->forceDelete();
        }

        if ($count > 0) {
            $this->info("Berhasil menghapus $count users yang sudah dihapus lebih dari 30 hari.");
        } else {
            $this->info("Tidak ada users yang sudah dihapus lebih dari 30 hari.");
        }
    }
}
