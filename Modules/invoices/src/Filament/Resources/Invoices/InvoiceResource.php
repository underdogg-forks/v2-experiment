<?php

namespace Modules\Invoices\Filament\Resources\Invoices;

use BackedEnum;
use Modules\Core\Filament\Resources\BaseResource as Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Invoices\Filament\Resources\Invoices\Pages\CreateInvoice;
use Modules\Invoices\Filament\Resources\Invoices\Pages\EditInvoice;
use Modules\Invoices\Filament\Resources\Invoices\Pages\ListInvoices;
use Modules\Invoices\Filament\Resources\Invoices\Schemas\InvoiceForm;
use Modules\Invoices\Filament\Resources\Invoices\Tables\InvoicesTable;
use Modules\Invoices\Models\Invoice;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return InvoiceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InvoicesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListInvoices::route('/'),
            'create' => CreateInvoice::route('/create'),
            'edit'   => EditInvoice::route('/{record}/edit'),
        ];
    }
}
