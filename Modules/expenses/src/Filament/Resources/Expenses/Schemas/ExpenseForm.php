<?php

namespace Modules\Expenses\Filament\Resources\Expenses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
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
