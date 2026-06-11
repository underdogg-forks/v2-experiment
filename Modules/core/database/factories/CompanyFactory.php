<?php

namespace Modules\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Core\Models\Company;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'search_code' => fake()->unique()->regexify('[A-Z]{6}[0-9]{4}'),
            'name'        => fake()->company(),
            'slug'        => fake()->unique()->slug(),
            'vat_number'  => fake()->optional()->numerify('NL########B##'),
        ];
    }
}
