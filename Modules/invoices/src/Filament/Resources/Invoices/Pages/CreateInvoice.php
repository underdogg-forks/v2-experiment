<?php

namespace Modules\Invoices\Filament\Resources\Invoices\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Invoices\Filament\Resources\Invoices\InvoiceResource;
use Modules\Invoices\Services\InvoiceService;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return app(InvoiceService::class)->createInvoice($data);
    }
}
