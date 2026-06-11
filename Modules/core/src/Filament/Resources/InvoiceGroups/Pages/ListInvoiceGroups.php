<?php

namespace Modules\Core\Filament\Resources\InvoiceGroups\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Core\Filament\Resources\InvoiceGroups\InvoiceGroupResource;

class ListInvoiceGroups extends ListRecords
{
    protected static string $resource = InvoiceGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
