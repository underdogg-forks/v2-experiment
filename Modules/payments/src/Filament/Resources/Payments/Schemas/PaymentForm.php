<?php

namespace Modules\Payments\Filament\Resources\Payments\Schemas;

use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Modules\Invoices\Models\Invoice;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('invoice_id')
                    ->options(fn () => Invoice::query()
                        ->where('company_id', Filament::getTenant()?->id)
                        ->pluck('invoice_number', 'invoice_id'))
                    ->required(),
                TextInput::make('payment_method_id')
                    ->required()
                    ->numeric()
                    ->default(0),
                DatePicker::make('payment_date')
                    ->required(),
                TextInput::make('payment_amount')
                    ->required()
                    ->numeric(),
                Textarea::make('payment_note')
                    ->default('')
                    ->columnSpanFull(),
            ]);
    }
}
