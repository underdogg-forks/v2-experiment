<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Project>
 */
final class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'       => \App\Models\Company::factory(),
            'client_id'        => fake()->randomNumber(),
            'project_name'     => fake()->optional()->text,
            'client_client_id' => \App\Models\Client::factory(),
        ];
    }
}
