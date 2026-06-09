<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Company>
 */
final class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'search_code'      => fake()->word,
            'name'             => fake()->name,
            'slug'             => fake()->slug,
            'vat_number'       => fake()->optional()->word,
            'id_number'        => fake()->optional()->word,
            'coc_number'       => fake()->optional()->word,
            'logo'             => fake()->optional()->word,
            'quote_template'   => fake()->optional()->word,
            'invoice_template' => fake()->optional()->word,
        ];
    }
}
