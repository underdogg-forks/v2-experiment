<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ClientCustom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ClientCustom>
 */
final class ClientCustomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientCustom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'               => \App\Models\Company::factory(),
            'client_id'                => fake()->randomNumber(),
            'client_custom_fieldid'    => fake()->randomNumber(),
            'client_custom_fieldvalue' => fake()->optional()->text,
            'client_client_id'         => \App\Models\Client::factory(),
        ];
    }
}
