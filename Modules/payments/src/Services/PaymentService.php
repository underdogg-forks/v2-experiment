<?php

namespace Modules\Payments\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Payments\Models\Payment;

class PaymentService
{
    public function createPayment(array $data): Payment
    {
        return Payment::query()->create($data);
    }

    public function updatePayment(Payment $payment, array $data): Payment
    {
        $payment->update($data);

        return $payment->fresh();
    }

    public function deletePayment(Payment $payment): bool
    {
        return (bool) $payment->delete();
    }

    public function listForCompany(int $companyId): Collection
    {
        return Payment::query()
            ->where('company_id', $companyId)
            ->with(['invoice'])
            ->latest('payment_date')
            ->get();
    }
}
