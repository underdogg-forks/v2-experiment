<?php

namespace App\Filament\App\Resources\InvoiceGroups;

use App\Filament\App\Resources\InvoiceGroups\Pages\CreateInvoiceGroup;
use App\Filament\App\Resources\InvoiceGroups\Pages\EditInvoiceGroup;
use App\Filament\App\Resources\InvoiceGroups\Pages\ListInvoiceGroups;
use App\Filament\App\Resources\InvoiceGroups\Schemas\InvoiceGroupForm;
use App\Filament\App\Resources\InvoiceGroups\Tables\InvoiceGroupsTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Core\Models\InvoiceGroup;

class InvoiceGroupResource extends Resource
{
    protected static ?string $model = InvoiceGroup::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return InvoiceGroupForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InvoiceGroupsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListInvoiceGroups::route('/'),
            'create' => CreateInvoiceGroup::route('/create'),
            'edit'   => EditInvoiceGroup::route('/{record}/edit'),
        ];
    }
}
