<?php

namespace App\Filament\Resources\PelamarResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
class EditPelamar extends EditRecord
{
    protected static string $resource = EditPelamar::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}