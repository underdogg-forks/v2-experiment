<?php

namespace Modules\Core\Filament\Resources\InvoiceGroups\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Core\Filament\Resources\InvoiceGroups\InvoiceGroupResource;

class EditInvoiceGroup extends EditRecord
{
    protected static string $resource = InvoiceGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
