<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ImportDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ImportDetail>
 */
final class ImportDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImportDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'import_id'         => fake()->randomNumber(),
            'import_lang_key'   => fake()->word,
            'import_table_name' => fake()->word,
            'import_record_id'  => fake()->randomNumber(),
            'import_import_id'  => \App\Models\Import::factory(),
        ];
    }
}
