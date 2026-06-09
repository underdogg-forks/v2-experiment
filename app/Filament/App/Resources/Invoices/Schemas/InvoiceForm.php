<?php

namespace App\Filament\App\Resources\Invoices\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                Select::make('client_id')
                    ->relationship('client', 'client_id')
                    ->required(),
                Select::make('invoice_group_id')
                    ->relationship('invoice_group', 'invoice_group_id')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'user_id')
                    ->required(),
                TextInput::make('invoice_status_id')
                    ->required()
                    ->numeric()
                    ->default(1),
                Toggle::make('is_read_only'),
                TextInput::make('invoice_password')
                    ->password()
                    ->default(null),
                DatePicker::make('invoice_date_created')
                    ->required(),
                TimePicker::make('invoice_time_created')
                    ->required(),
                DateTimePicker::make('invoice_date_modified')
                    ->required(),
                DatePicker::make('invoice_date_due')
                    ->required(),
                TextInput::make('invoice_number')
                    ->default(null),
                TextInput::make('invoice_discount_amount')
                    ->numeric()
                    ->default(null),
                TextInput::make('invoice_discount_percent')
                    ->numeric()
                    ->default(null),
                Textarea::make('invoice_terms')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('invoice_url_key')
                    ->required(),
                TextInput::make('payment_method')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('creditinvoice_parent_id')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
