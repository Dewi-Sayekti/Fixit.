<?php

namespace App\Filament\Resources\Ratings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RatingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('aduan_id')
                    ->required()
                    ->numeric(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('value')
                    ->required()
                    ->numeric(),
            ]);
    }
}
