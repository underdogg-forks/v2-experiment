<?php

namespace Modules\Projects\Database\Seeders;

use Modules\Core\Database\Seeders\AbstractSeeder;
use Modules\Projects\Models\Project;

class ProjectsSeeder extends AbstractSeeder
{
    protected string $label = 'Projects';

    protected int $defaultCount = 15;

    protected function buildOne(): void
    {
        $client = $this->findOrCreateClient($this->companyId);

        Project::factory()->create([
            'company_id' => $this->companyId,
            'client_id'  => $client->client_id,
        ]);
    }
}
