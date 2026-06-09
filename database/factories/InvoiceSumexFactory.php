<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\InvoiceSumex;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\InvoiceSumex>
 */
final class InvoiceSumexFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceSumex::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'           => \App\Models\Company::factory(),
            'sumex_invoice'        => \App\Models\Invoice::factory(),
            'sumex_reason'         => fake()->randomNumber(),
            'sumex_diagnosis'      => fake()->word,
            'sumex_observations'   => fake()->word,
            'sumex_treatmentstart' => fake()->date(),
            'sumex_treatmentend'   => fake()->date(),
            'sumex_casedate'       => fake()->date(),
            'sumex_casenumber'     => fake()->optional()->word,
        ];
    }
}
