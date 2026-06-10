<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Upload;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Upload>
 */
final class UploadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Upload::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'         => \App\Models\Company::factory(),
            'client_id'          => \App\Models\Client::factory(),
            'url_key'            => fake()->word,
            'file_name_original' => fake()->word,
            'file_name_new'      => fake()->word,
            'uploaded_date'      => fake()->date(),
        ];
    }
}
