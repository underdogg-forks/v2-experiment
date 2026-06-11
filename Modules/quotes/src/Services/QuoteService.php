<?php

namespace Modules\Quotes\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Quotes\Models\Quote;

class QuoteService
{
    public function createQuote(array $data): Quote
    {
        return Quote::query()->create($data);
    }

    public function updateQuote(Quote $quote, array $data): Quote
    {
        $quote->update($data);

        return $quote->fresh();
    }

    public function deleteQuote(Quote $quote): bool
    {
        return (bool) $quote->delete();
    }

    public function listForCompany(int $companyId): Collection
    {
        return Quote::query()
            ->where('company_id', $companyId)
            ->with(['client', 'invoice_group'])
            ->latest('quote_date_created')
            ->get();
    }
}
