<?php

namespace Modules\Core\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Core\Models\TaxRate;

class TaxRateService
{
    public function createTaxRate(array $data): TaxRate
    {
        return TaxRate::query()->create($data);
    }

    public function updateTaxRate(TaxRate $taxRate, array $data): TaxRate
    {
        $taxRate->update($data);

        return $taxRate->fresh();
    }

    public function deleteTaxRate(TaxRate $taxRate): bool
    {
        return (bool) $taxRate->delete();
    }

    public function listForCompany(int $companyId): Collection
    {
        return TaxRate::query()
            ->where('company_id', $companyId)
            ->orderBy('tax_rate_name')
            ->get();
    }
}
