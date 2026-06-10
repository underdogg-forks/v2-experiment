<?php

namespace Modules\Core\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('search_code')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('vat_number')
                    ->default(null),
                TextInput::make('id_number')
                    ->default(null),
                TextInput::make('coc_number')
                    ->default(null),
                TextInput::make('logo')
                    ->default(null),
                TextInput::make('quote_template')
                    ->default(null),
                TextInput::make('invoice_template')
                    ->default(null),
            ]);
    }
}
