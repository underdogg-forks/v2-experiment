<?php

namespace Modules\Core\Filament\Resources\InvoiceGroups\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Filament\Resources\InvoiceGroups\InvoiceGroupResource;
use Modules\Core\Services\InvoiceGroupService;

class CreateInvoiceGroup extends CreateRecord
{
    protected static string $resource = InvoiceGroupResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return app(InvoiceGroupService::class)->createInvoiceGroup($data);
    }
}
