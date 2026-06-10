<?php

namespace Modules\Invoices\Filament\Resources\Invoices;

use BackedEnum;
use Filament\Facades\Filament;
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

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data = parent::mutateFormDataBeforeCreate($data);

        $data['user_id']                ??= Filament::auth()->user()?->getKey();
        $data['invoice_date_created']   ??= now()->toDateString();
        $data['invoice_time_created']   ??= now()->toTimeString();
        $data['invoice_date_modified']  ??= now();
        $data['invoice_date_due']       ??= now()->addDays(30)->toDateString();
        $data['invoice_terms']          ??= '';
        $data['invoice_url_key']        ??= \Illuminate\Support\Str::random(32);
        $data['payment_method']         ??= 0;

        return $data;
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
