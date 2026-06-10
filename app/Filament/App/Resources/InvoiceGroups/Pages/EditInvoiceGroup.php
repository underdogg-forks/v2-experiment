<?php

namespace App\Filament\App\Resources\InvoiceGroups\Pages;

use App\Filament\App\Resources\InvoiceGroups\InvoiceGroupResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

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
