<?php

namespace Modules\Core\Filament\Resources\TaxRates;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Core\Filament\Resources\TaxRates\Pages\CreateTaxRate;
use Modules\Core\Filament\Resources\TaxRates\Pages\EditTaxRate;
use Modules\Core\Filament\Resources\TaxRates\Pages\ListTaxRates;
use Modules\Core\Filament\Resources\TaxRates\Schemas\TaxRateForm;
use Modules\Core\Filament\Resources\TaxRates\Tables\TaxRatesTable;
use Modules\Core\Models\TaxRate;

class TaxRateResource extends Resource
{
    protected static ?string $model = TaxRate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TaxRateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TaxRatesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListTaxRates::route('/'),
            'create' => CreateTaxRate::route('/create'),
            'edit'   => EditTaxRate::route('/{record}/edit'),
        ];
    }
}
