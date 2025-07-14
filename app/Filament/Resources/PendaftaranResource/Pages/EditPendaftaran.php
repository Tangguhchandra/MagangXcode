<?php

namespace App\Filament\Resources\PendaftaranResource\Pages;

use App\Filament\Resources\PendaftaranResource;
use App\Notifications\MailMassage;
use Illuminate\Support\Facades\Notification;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification as FilamentNotification;
class EditPendaftaran extends EditRecord
{
    protected static string $resource = PendaftaranResource::class;

    // Store original status before save
    protected $originalStatus;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // Hook before save to capture original status
    protected function beforeSave(): void
    {
        $this->originalStatus = $this->record->getOriginal('status');

        Log::info('Before save - Original status captured', [
            'original_status' => $this->originalStatus,
            'pendaftaran_id' => $this->record->id,
            'new_status' => $this->data['status'] ?? 'not set',
         ]);
    }  

    // Hook after save to send email notification

    protected function aftersave(): void
    {
        $pendaftaran = $this->record;
        $newStatus = $this->data['status'] ?? null;

        Log::info('After save - New status', [
          'original_status' => $this->originalStatus,
            'new_status' => $newStatus,
            'pendaftaran_id' => $pendaftaran->id,
            'email' => $pendaftaran->email
        ]);


        // check if status has changed
        if($this->originalStatus !== 'diterima' && $newStatus === 'diterima'){
              try {
                // Send email notification
                if ($pendaftaran->email) {
                    Notification::route('mail', $pendaftaran->email)
                        ->notify(new MailMassage($pendaftaran));

                    // Show success notification in Filament
                    FilamentNotification::make()
                        ->title('Email Terkirim')
                        ->body('Notifikasi email telah dikirim ke ' . $pendaftaran->email)
                        ->success()
                        ->send();

                    Log::info('Email notification sent successfully', [
                        'pendaftaran_id' => $pendaftaran->id,
                        'email' => $pendaftaran->email
                    ]);
                } else {
                    // Show warning if no email
                    FilamentNotification::make()
                        ->title('Peringatan')
                        ->body('Email tidak dapat dikirim karena alamat email tidak tersedia')
                        ->warning()
                        ->send();

                    Log::warning('No email address available for pendaftaran', [
                        'pendaftaran_id' => $pendaftaran->id
                    ]);
                }
            } catch (\Exception $e) {
                // Show error notification
                FilamentNotification::make()
                    ->title('Error')
                    ->body('Gagal mengirim email: ' . $e->getMessage())
                    ->danger()
                    ->send();

                Log::error('Failed to send email notification', [
                    'pendaftaran_id' => $pendaftaran->id,
                    'email' => $pendaftaran->email,
                    'error' => $e->getMessage()
                ]);
            }
        }
    }
}