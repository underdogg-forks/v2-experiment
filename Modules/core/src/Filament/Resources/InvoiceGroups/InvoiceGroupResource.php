<?php

namespace Modules\Core\Filament\Resources\InvoiceGroups;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Core\Filament\Resources\InvoiceGroups\Pages\CreateInvoiceGroup;
use Modules\Core\Filament\Resources\InvoiceGroups\Pages\EditInvoiceGroup;
use Modules\Core\Filament\Resources\InvoiceGroups\Pages\ListInvoiceGroups;
use Modules\Core\Filament\Resources\InvoiceGroups\Schemas\InvoiceGroupForm;
use Modules\Core\Filament\Resources\InvoiceGroups\Tables\InvoiceGroupsTable;
use Modules\Invoices\Models\InvoiceGroup;

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
