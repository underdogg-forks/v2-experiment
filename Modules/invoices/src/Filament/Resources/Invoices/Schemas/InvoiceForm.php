<?php

namespace Modules\Invoices\Filament\Resources\Invoices\Schemas;

use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Modules\Clients\Models\Client;
use Modules\Core\Models\InvoiceGroup;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('client_id')
                    ->options(fn () => Client::query()
                        ->where('company_id', Filament::getTenant()?->id)
                        ->pluck('client_name', 'client_id'))
                    ->searchable()
                    ->required(),
                Select::make('invoice_group_id')
                    ->options(fn () => InvoiceGroup::query()
                        ->where('company_id', Filament::getTenant()?->id)
                        ->pluck('invoice_group_name', 'invoice_group_id'))
                    ->required(),
                TextInput::make('invoice_status_id')
                    ->numeric()
                    ->default(1),
                Toggle::make('is_read_only')
                    ->default(false),
                DatePicker::make('invoice_date_created')
                    ->default(null),
                DatePicker::make('invoice_date_due')
                    ->default(null),
                TextInput::make('invoice_number')
                    ->default(null),
                TextInput::make('invoice_discount_amount')
                    ->numeric()
                    ->default(null),
                TextInput::make('invoice_discount_percent')
                    ->numeric()
                    ->default(null),
                Textarea::make('invoice_terms')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
