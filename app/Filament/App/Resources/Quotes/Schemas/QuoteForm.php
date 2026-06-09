<?php

namespace App\Filament\App\Resources\Quotes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QuoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                TextInput::make('invoice_id')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('user_id')
                    ->relationship('user', 'user_id')
                    ->required(),
                Select::make('client_id')
                    ->relationship('client', 'client_id')
                    ->required(),
                Select::make('invoice_group_id')
                    ->relationship('invoice_group', 'invoice_group_id')
                    ->required(),
                TextInput::make('quote_status_id')
                    ->required()
                    ->numeric()
                    ->default(1),
                DatePicker::make('quote_date_expires')
                    ->required(),
                TextInput::make('quote_number')
                    ->default(null),
                TextInput::make('quote_discount_amount')
                    ->numeric()
                    ->default(null),
                TextInput::make('quote_discount_percent')
                    ->numeric()
                    ->default(null),
                TextInput::make('quote_url_key')
                    ->required(),
                TextInput::make('quote_password')
                    ->password()
                    ->default(null),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
                DatePicker::make('quote_date_created')
                    ->required(),
                DateTimePicker::make('quote_date_modified')
                    ->required(),
            ]);
    }
}
