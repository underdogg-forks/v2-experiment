<?php

namespace Modules\Expenses\Filament\Resources\ExpenseCategories\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Expenses\Filament\Resources\ExpenseCategories\ExpenseCategoryResource;

class CreateExpenseCategory extends CreateRecord
{
    protected static string $resource = ExpenseCategoryResource::class;
}
