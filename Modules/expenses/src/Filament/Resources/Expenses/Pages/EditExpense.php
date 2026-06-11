<?php

namespace Modules\Expenses\Filament\Resources\Expenses\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Expenses\Filament\Resources\Expenses\ExpenseResource;
use Modules\Expenses\Services\ExpenseService;

class EditExpense extends EditRecord
{
    protected static string $resource = ExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return app(ExpenseService::class)->updateExpense($record, $data);
    }
}
