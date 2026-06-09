<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\LoginLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\LoginLog>
 */
final class LoginLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LoginLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'login_name'           => fake()->word,
            'log_count'            => fake()->optional()->randomNumber(),
            'log_create_timestamp' => fake()->optional()->dateTime(),
        ];
    }
}
