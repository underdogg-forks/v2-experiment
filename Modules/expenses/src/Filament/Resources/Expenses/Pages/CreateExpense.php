<?php

namespace Modules\Expenses\Filament\Resources\Expenses\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Expenses\Filament\Resources\Expenses\ExpenseResource;
use Modules\Expenses\Services\ExpenseService;

class CreateExpense extends CreateRecord
{
    protected static string $resource = ExpenseResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return app(ExpenseService::class)->createExpense($data);
    }
}
