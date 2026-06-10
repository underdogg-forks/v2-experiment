<?php

namespace Modules\Expenses\Filament\Resources\ExpenseCategories;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Expenses\Filament\Resources\ExpenseCategories\Pages\CreateExpenseCategory;
use Modules\Expenses\Filament\Resources\ExpenseCategories\Pages\EditExpenseCategory;
use Modules\Expenses\Filament\Resources\ExpenseCategories\Pages\ListExpenseCategories;
use Modules\Expenses\Filament\Resources\ExpenseCategories\Schemas\ExpenseCategoryForm;
use Modules\Expenses\Filament\Resources\ExpenseCategories\Tables\ExpenseCategoriesTable;
use Modules\Expenses\Models\ExpenseCategory;

class ExpenseCategoryResource extends Resource
{
    protected static ?string $model = ExpenseCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ExpenseCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExpenseCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListExpenseCategories::route('/'),
            'create' => CreateExpenseCategory::route('/create'),
            'edit'   => EditExpenseCategory::route('/{record}/edit'),
        ];
    }
}
