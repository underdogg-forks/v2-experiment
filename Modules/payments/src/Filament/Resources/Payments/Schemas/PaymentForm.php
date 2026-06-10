<?php

namespace Modules\Payments\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('invoice_id')
                    ->relationship('invoice', 'invoice_id')
                    ->required(),
                TextInput::make('payment_method_id')
                    ->required()
                    ->numeric()
                    ->default(0),
                DatePicker::make('payment_date')
                    ->required(),
                TextInput::make('payment_amount')
                    ->numeric()
                    ->default(null),
                Textarea::make('payment_note')
                    ->default('')
                    ->columnSpanFull(),
            ]);
    }
}
