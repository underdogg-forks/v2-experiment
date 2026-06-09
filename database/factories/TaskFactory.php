<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Task>
 */
final class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'           => \App\Models\Company::factory(),
            'project_id'           => fake()->randomNumber(),
            'task_name'            => fake()->optional()->word,
            'task_description'     => fake()->word,
            'task_price'           => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'task_finish_date'     => fake()->date(),
            'task_status'          => fake()->randomNumber(1),
            'tax_rate_id'          => fake()->randomNumber(),
            'project_project_id'   => \App\Models\Project::factory(),
            'tax_rate_tax_rate_id' => \App\Models\TaxRate::factory(),
        ];
    }
}
