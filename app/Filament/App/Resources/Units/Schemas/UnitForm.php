<?php

namespace App\Filament\App\Resources\Units\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                TextInput::make('unit_name')
                    ->default(null),
                TextInput::make('unit_name_plrl')
                    ->default(null),
            ]);
    }
}
