<?php

namespace Modules\Invoices\Filament\Resources\Invoices\Pages;

use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Invoices\Filament\Resources\Invoices\InvoiceResource;
use Modules\Invoices\Services\InvoiceService;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] ??= Filament::auth()->user()?->getKey();
        $data['invoice_date_created'] ??= now()->toDateString();
        $data['invoice_time_created'] ??= now()->toTimeString();
        $data['invoice_date_modified'] ??= now();
        $data['invoice_date_due'] ??= now()->addDays(30)->toDateString();
        $data['invoice_terms'] ??= '';
        $data['invoice_url_key'] ??= \Illuminate\Support\Str::random(32);
        $data['payment_method'] ??= 0;

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        return app(InvoiceService::class)->createInvoice($data);
    }
}
