<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\InvoicesRecurring;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\InvoicesRecurring>
 */
final class InvoicesRecurringFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoicesRecurring::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'       => \App\Models\Company::factory(),
            'invoice_id'       => \App\Models\Invoice::factory(),
            'recur_start_date' => fake()->date(),
            'recur_end_date'   => fake()->optional()->date(),
            'recur_frequency'  => fake()->word,
            'recur_next_date'  => fake()->optional()->date(),
        ];
    }
}
