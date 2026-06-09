<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CustomValue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CustomValue>
 */
final class CustomValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomValue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'          => \App\Models\Company::factory(),
            'custom_values_field' => fake()->randomNumber(),
            'custom_values_value' => fake()->text,
        ];
    }
}
