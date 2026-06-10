<?php

namespace App\Filament\App\Resources\InvoiceGroups\Pages;

use App\Filament\App\Resources\InvoiceGroups\InvoiceGroupResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInvoiceGroup extends CreateRecord
{
    protected static string $resource = InvoiceGroupResource::class;
}
