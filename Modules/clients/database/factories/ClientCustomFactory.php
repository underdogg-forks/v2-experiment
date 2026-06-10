<?php

namespace Modules\Clients\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Clients\Models\Client;
use Modules\Clients\Models\ClientCustom;
use Modules\Core\Models\Company;

/**
 * @extends Factory<ClientCustom>
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
            'company_id'               => Company::factory(),
            'client_id'                => fake()->randomNumber(),
            'client_custom_fieldid'    => fake()->randomNumber(),
            'client_custom_fieldvalue' => fake()->optional()->text,
            'client_client_id'         => Client::factory(),
        ];
    }
}
