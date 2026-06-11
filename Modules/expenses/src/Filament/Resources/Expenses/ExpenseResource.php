<?php

namespace Modules\Expenses\Filament\Resources\Expenses;

use BackedEnum;
use Modules\Core\Filament\Resources\BaseResource as Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Expenses\Filament\Resources\Expenses\Pages\CreateExpense;
use Modules\Expenses\Filament\Resources\Expenses\Pages\EditExpense;
use Modules\Expenses\Filament\Resources\Expenses\Pages\ListExpenses;
use Modules\Expenses\Filament\Resources\Expenses\Schemas\ExpenseForm;
use Modules\Expenses\Filament\Resources\Expenses\Tables\ExpensesTable;
use Modules\Expenses\Models\Expense;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ExpenseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExpensesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListExpenses::route('/'),
            'create' => CreateExpense::route('/create'),
            'edit'   => EditExpense::route('/{record}/edit'),
        ];
    }
}
