<?php

namespace Modules\Core\Filament\Resources\TaxRates\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TaxRateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                Textarea::make('tax_rate_name')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('tax_rate_percent')
                    ->required()
                    ->numeric(),
            ]);
    }
}
