<?php

namespace App\Filament\App\Resources\InvoiceGroups\Pages;

use App\Filament\App\Resources\InvoiceGroups\InvoiceGroupResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

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
