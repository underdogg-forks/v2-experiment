<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\InvoiceGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\InvoiceGroup>
 */
final class InvoiceGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'                      => \App\Models\Company::factory(),
            'invoice_group_name'              => fake()->optional()->text,
            'invoice_group_identifier_format' => fake()->word,
            'invoice_group_next_id'           => fake()->randomNumber(),
            'invoice_group_left_pad'          => fake()->randomNumber(),
        ];
    }
}
