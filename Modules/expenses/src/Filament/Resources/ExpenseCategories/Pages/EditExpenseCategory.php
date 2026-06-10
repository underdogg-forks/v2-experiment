<?php

namespace Modules\Expenses\Filament\Resources\ExpenseCategories\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Expenses\Filament\Resources\ExpenseCategories\ExpenseCategoryResource;

class EditExpenseCategory extends EditRecord
{
    protected static string $resource = ExpenseCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
