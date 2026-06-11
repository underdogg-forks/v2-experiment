<?php

namespace Modules\Core\Filament\Resources\TaxRates\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TaxRateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tax_rate_name')
                    ->required(),
                TextInput::make('tax_rate_percent')
                    ->required()
                    ->numeric(),
            ]);
    }
}
