<?php

namespace Modules\Products\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                Select::make('family_id')
                    ->relationship('family', 'family_id')
                    ->default(null),
                TextInput::make('product_sku')
                    ->default(null),
                TextInput::make('product_name')
                    ->default(null),
                Textarea::make('product_description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('product_price')
                    ->numeric()
                    ->default(null)
                    ->prefix('$'),
                TextInput::make('purchase_price')
                    ->numeric()
                    ->default(null)
                    ->prefix('$'),
                TextInput::make('provider_name')
                    ->default(null),
                Select::make('tax_rate_id')
                    ->relationship('tax_rate', 'tax_rate_id')
                    ->default(null),
                Select::make('unit_id')
                    ->relationship('unit', 'unit_id')
                    ->default(null),
                TextInput::make('product_tariff')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
