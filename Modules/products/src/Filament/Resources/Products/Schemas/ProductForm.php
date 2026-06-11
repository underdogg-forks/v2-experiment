<?php

namespace Modules\Products\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Modules\Core\Models\TaxRate;
use Modules\Products\Models\Unit;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('product_sku')
                    ->default(null),
                TextInput::make('product_name')
                    ->required(),
                Textarea::make('product_description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('product_price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('purchase_price')
                    ->numeric()
                    ->default(null)
                    ->prefix('$'),
                TextInput::make('provider_name')
                    ->default(null),
                Select::make('tax_rate_id')
                    ->options(fn () => TaxRate::query()->pluck('tax_rate_name', 'tax_rate_id'))
                    ->default(null),
                Select::make('unit_id')
                    ->options(fn () => Unit::query()->pluck('unit_name', 'unit_id'))
                    ->default(null),
                TextInput::make('product_tariff')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
