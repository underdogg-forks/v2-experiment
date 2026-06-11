<?php

namespace Modules\Core\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Core\Models\InvoiceGroup;

class InvoiceGroupService
{
    public function createInvoiceGroup(array $data): InvoiceGroup
    {
        return InvoiceGroup::query()->create($data);
    }

    public function updateInvoiceGroup(InvoiceGroup $invoiceGroup, array $data): InvoiceGroup
    {
        $invoiceGroup->update($data);

        return $invoiceGroup->fresh();
    }

    public function deleteInvoiceGroup(InvoiceGroup $invoiceGroup): bool
    {
        return (bool) $invoiceGroup->delete();
    }

    public function listForCompany(int $companyId): Collection
    {
        return InvoiceGroup::query()
            ->where('company_id', $companyId)
            ->orderBy('invoice_group_name')
            ->get();
    }
}
