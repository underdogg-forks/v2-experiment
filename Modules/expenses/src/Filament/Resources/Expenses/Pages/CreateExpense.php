<?php

namespace Modules\Expenses\Filament\Resources\Expenses\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Expenses\Filament\Resources\Expenses\ExpenseResource;

class CreateExpense extends CreateRecord
{
    protected static string $resource = ExpenseResource::class;
}
