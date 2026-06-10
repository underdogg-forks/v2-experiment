<?php

namespace Modules\Quotes\Filament\Resources\Quotes\Schemas;

use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Modules\Clients\Models\Client;
use Modules\Core\Models\InvoiceGroup;

class QuoteForm
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
                TextInput::make('quote_status_id')
                    ->numeric()
                    ->default(1),
                DatePicker::make('quote_date_expires')
                    ->default(null),
                TextInput::make('quote_number')
                    ->default(null),
                TextInput::make('quote_discount_amount')
                    ->numeric()
                    ->default(null),
                TextInput::make('quote_discount_percent')
                    ->numeric()
                    ->default(null),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
