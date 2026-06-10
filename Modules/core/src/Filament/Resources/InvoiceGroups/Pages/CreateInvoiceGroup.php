<?php

namespace Modules\Core\Filament\Resources\InvoiceGroups\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Core\Filament\Resources\InvoiceGroups\InvoiceGroupResource;

class CreateInvoiceGroup extends CreateRecord
{
    protected static string $resource = InvoiceGroupResource::class;
}
