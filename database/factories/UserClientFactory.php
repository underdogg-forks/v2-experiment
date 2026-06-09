<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UserClient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\UserClient>
 */
final class UserClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserClient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'       => \App\Models\Company::factory(),
            'client_id'        => fake()->randomNumber(),
            'user_id'          => fake()->randomNumber(),
            'client_client_id' => \App\Models\Client::factory(),
            'user_user_id'     => \App\Models\User::factory(),
        ];
    }
}
