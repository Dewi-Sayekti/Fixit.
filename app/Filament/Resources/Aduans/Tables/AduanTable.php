<?php

namespace App\Filament\Resources\Aduans;

use App\Filament\Resources\Aduans\Pages\CreateAduan;
use App\Filament\Resources\Aduans\Pages\EditAduan;
use App\Filament\Resources\Aduans\Pages\ListAduans;
use App\Filament\Resources\Aduans\Schemas\AduanForm;
use App\Filament\Resources\Aduans\Tables\AduansTable;
use App\Models\Aduan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AduanResource extends Resource
{
    protected static ?string $model = Aduan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'keterangan';

    public static function form(Schema $schema): Schema
    {
        return AduanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AduansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAduans::route('/'),
            'create' => CreateAduan::route('/create'),
            'edit' => EditAduan::route('/{record}/edit'),
        ];
    }
}
