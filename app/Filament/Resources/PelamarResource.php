<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelamarResource\Pages;
use App\Models\Pelamar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Notifications\Notification;

class PelamarResource extends Resource
{
    protected static ?string $model = Pelamar::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Data Pelamar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('divisi')->required(),
                
                Select::make('status')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ])
                    ->afterStateUpdated(function ($state, $record) {
                        // Kirim notifikasi email (opsional)
                        Notification::make()
                            ->title("Status pelamar diubah menjadi: $state")
                            ->success()
                            ->send();
                    })
                    ->required(),

                FileUpload::make('cv')
                    ->label('Upload CV')
                    ->downloadable()
                    ->directory('cv')
                    ->required(),

                FileUpload::make('portofolio')
                    ->label('Upload Portofolio')
                    ->downloadable()
                    ->directory('portofolio'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->searchable()->sortable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('divisi'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                        'menunggu' => 'warning',
                        default => 'gray',
                    }),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPelamars::route('/'),
            'create' => Pages\CreatePelamar::route('/create'),
            'edit' => Pages\EditPelamar::route('/{record}/edit'),
        ];
    }
}
