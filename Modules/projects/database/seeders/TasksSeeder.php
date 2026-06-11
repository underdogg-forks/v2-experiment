<?php

namespace Modules\Projects\Database\Seeders;

use Modules\Core\Database\Seeders\AbstractSeeder;
use Modules\Projects\Models\Task;

class TasksSeeder extends AbstractSeeder
{
    protected string $label = 'Tasks';

    protected int $defaultCount = 25;

    protected function buildOne(): void
    {
        $project = $this->findOrCreateProject($this->companyId);

        Task::factory()->create([
            'company_id' => $this->companyId,
            'project_id' => $project->project_id,
        ]);
    }
}
