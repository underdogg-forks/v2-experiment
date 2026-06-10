<?php

namespace Modules\Projects\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Projects\Models\Project;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'company_id'   => \Modules\Core\Models\Company::factory(),
            'client_id'    => \Modules\Clients\Models\Client::factory(),
            'project_name' => fake()->words(3, true),
        ];
    }
}
