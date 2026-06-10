<?php

namespace App\Filament\App\Resources\Expenses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                Select::make('invoice_id')
                    ->relationship('invoice', 'invoice_id')
                    ->default(null),
                TextInput::make('customer_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('vendor_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('category_id')
                    ->numeric()
                    ->default(null),
                Select::make('user_id')
                    ->relationship('user', 'user_id')
                    ->default(null),
                TextInput::make('expense_number')
                    ->required(),
                TextInput::make('expense_status')
                    ->required(),
                TextInput::make('expense_type')
                    ->required(),
                DatePicker::make('expensed_at')
                    ->required(),
                TextInput::make('expense_amount')
                    ->required()
                    ->numeric(),
                TextInput::make('description')
                    ->default(null),
            ]);
    }
}
