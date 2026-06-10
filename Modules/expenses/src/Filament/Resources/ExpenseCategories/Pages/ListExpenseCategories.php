<?php

namespace Modules\Expenses\Filament\Resources\ExpenseCategories\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Expenses\Filament\Resources\ExpenseCategories\ExpenseCategoryResource;

class ListExpenseCategories extends ListRecords
{
    protected static string $resource = ExpenseCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
