<?php

namespace Modules\Payments\Database\Seeders;

use Modules\Core\Database\Seeders\AbstractSeeder;
use Modules\Payments\Models\Payment;

class PaymentsSeeder extends AbstractSeeder
{
    protected string $label = 'Payments';

    protected int $defaultCount = 15;

    protected function buildOne(): void
    {
        $invoice = $this->findOrCreateInvoice($this->companyId);

        Payment::factory()->create([
            'company_id' => $this->companyId,
            'invoice_id' => $invoice->invoice_id,
        ]);
    }
}
