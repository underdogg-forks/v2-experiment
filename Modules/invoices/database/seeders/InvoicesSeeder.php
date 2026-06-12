<?php

namespace Modules\Invoices\Database\Seeders;

use Modules\Core\Database\Seeders\AbstractSeeder;
use Modules\Invoices\Models\Invoice;

class InvoicesSeeder extends AbstractSeeder
{
    protected string $label = 'Invoices';

    protected int $defaultCount = 25;

    protected function buildOne(): void
    {
        $client = $this->findOrCreateClient($this->companyId);
        $group  = $this->findOrCreateInvoiceGroup($this->companyId);
        $user   = $this->findOrCreateUser($this->companyId);

        Invoice::factory()->create([
            'company_id'       => $this->companyId,
            'client_id'        => $client->client_id,
            'invoice_group_id' => $group->invoice_group_id,
            'user_id'          => $user->user_id,
        ]);
    }
}
