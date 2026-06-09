<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CustomField;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CustomField>
 */
final class CustomFieldFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomField::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'            => \App\Models\Company::factory(),
            'custom_field_table'    => fake()->optional()->word,
            'custom_field_label'    => fake()->optional()->word,
            'custom_field_type'     => fake()->word,
            'custom_field_location' => fake()->optional()->randomNumber(),
            'custom_field_order'    => fake()->optional()->randomNumber(),
        ];
    }
}
