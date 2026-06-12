<?php

namespace Modules\Clients\Database\Seeders;

use Modules\Clients\Models\Client;
use Modules\Core\Database\Seeders\AbstractSeeder;

class ClientsSeeder extends AbstractSeeder
{
    protected string $label = 'Clients';

    protected int $defaultCount = 15;

    protected function buildOne(): void
    {
        Client::factory()->create(['company_id' => $this->companyId]);
    }
}
