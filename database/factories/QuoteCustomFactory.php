<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\QuoteCustom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\QuoteCustom>
 */
final class QuoteCustomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuoteCustom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'              => \App\Models\Company::factory(),
            'quote_id'                => fake()->randomNumber(),
            'quote_custom_fieldid'    => fake()->randomNumber(),
            'quote_custom_fieldvalue' => fake()->optional()->text,
            'quote_quote_id'          => \App\Models\Quote::factory(),
        ];
    }
}
