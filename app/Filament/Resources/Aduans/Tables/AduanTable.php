<?php

namespace App\Filament\Resources\Aduans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AduansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('user.name')->label('Pengadu')->sortable(),
                TextColumn::make('zona.nama')->label('Zona')->sortable(),
                TextColumn::make('keterangan')->label('Keterangan')->limit(50),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'diadukan' => 'gray',
                        'diproses' => 'warning',
                        'perbaikan selesai' => 'success',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'diadukan' => 'Diadukan',
                        'diproses' => 'Sedang Diproses',
                        'perbaikan selesai' => 'Selesai',
                    }),
                TextColumn::make('created_at')->label('Dibuat')->dateTime()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'diadukan' => 'Diadukan',
                        'diproses' => 'Sedang Diproses',
                        'perbaikan selesai' => 'Selesai',
                    ])
                    ->placeholder('Pilih Status'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
