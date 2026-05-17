<?php

namespace App\Filament\Resources\Aduans\Pages;

use App\Filament\Resources\Aduans\AduanResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAduans extends ListRecords
{
    protected static string $resource = AduanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('filter_diadukan')
                ->label('Diadukan')
                ->action(fn () => $this->applyFilter('diadukan'))
                ->color(fn () => $this->getFilteredStatus() === 'diadukan' ? 'primary' : 'secondary')
                ->outlined(),
            Action::make('filter_diproses')
                ->label('Sedang Diproses')
                ->action(fn () => $this->applyFilter('diproses'))
                ->color(fn () => $this->getFilteredStatus() === 'diproses' ? 'primary' : 'secondary')
                ->outlined(),
            Action::make('filter_selesai')
                ->label('Selesai')
                ->action(fn () => $this->applyFilter('perbaikan selesai'))
                ->color(fn () => $this->getFilteredStatus() === 'perbaikan selesai' ? 'primary' : 'secondary')
                ->outlined(),
            Action::make('filter_all')
                ->label('Semua')
                ->action(fn () => $this->resetFilters())
                ->color(fn () => $this->getFilteredStatus() === null ? 'primary' : 'secondary')
                ->outlined(),
            CreateAction::make(),
        ];
    }

    public function applyFilter(string $status): void
    {
        $this->tableFilters = [
            'status' => ['value' => $status],
        ];
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->tableFilters = [];
        $this->resetPage();
    }

    public function getFilteredStatus(): ?string
    {
        return $this->tableFilters['status']['value'] ?? null;
    }
}
