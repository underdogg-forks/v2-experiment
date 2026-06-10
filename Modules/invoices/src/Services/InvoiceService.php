<?php

namespace Modules\Invoices\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Invoices\Models\Invoice;

class InvoiceService
{
    public function createInvoice(array $data): Invoice
    {
        return Invoice::query()->create($data);
    }

    public function updateInvoice(Invoice $invoice, array $data): Invoice
    {
        $invoice->update($data);

        return $invoice->fresh();
    }

    public function deleteInvoice(Invoice $invoice): bool
    {
        return (bool) $invoice->delete();
    }

    public function listForCompany(int $companyId): Collection
    {
        return Invoice::query()
            ->where('company_id', $companyId)
            ->with(['client', 'invoice_group'])
            ->latest('invoice_date_created')
            ->get();
    }

    public function findOrFail(int $invoiceId): Invoice
    {
        return Invoice::query()->findOrFail($invoiceId);
    }
}
