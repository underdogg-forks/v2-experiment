<?php

namespace Modules\Core\Filament\Resources\InvoiceGroups\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Filament\Resources\InvoiceGroups\InvoiceGroupResource;
use Modules\Core\Services\InvoiceGroupService;

class EditInvoiceGroup extends EditRecord
{
    protected static string $resource = InvoiceGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return app(InvoiceGroupService::class)->updateInvoiceGroup($record, $data);
    }
}
