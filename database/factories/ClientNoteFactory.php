<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ClientNote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ClientNote>
 */
final class ClientNoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientNote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'       => fake()->randomNumber(),
            'client_id'        => fake()->randomNumber(),
            'client_note_date' => fake()->date(),
            'client_note'      => fake()->word,
        ];
    }
}
