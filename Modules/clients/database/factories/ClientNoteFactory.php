<?php

namespace Modules\Clients\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Clients\Models\Client;
use Modules\Clients\Models\ClientNote;
use Modules\Core\Models\Company;

class ClientNoteFactory extends Factory
{
    protected $model = ClientNote::class;

    public function definition(): array
    {
        return [
            'company_id'       => Company::factory(),
            'client_id'        => Client::factory(),
            'client_note_date' => now(),
            'client_note'      => fake()->paragraph(),
        ];
    }
}
