<?php

namespace Modules\Projects\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Projects\Models\Task;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'company_id'       => \Modules\Core\Models\Company::factory(),
            'project_id'       => \Modules\Projects\Models\Project::factory(),
            'task_name'        => fake()->words(3, true),
            'task_description' => fake()->sentence(),
            'task_price'       => fake()->randomFloat(2, 10, 500),
            'task_finish_date' => now()->addDays(7),
            'task_status'      => false,
            'tax_rate_id'      => null,
        ];
    }
}
