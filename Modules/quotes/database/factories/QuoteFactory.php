<?php

namespace Modules\Quotes\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Quotes\Models\Quote;

class QuoteFactory extends Factory
{
    protected $model = Quote::class;

    public function definition(): array
    {
        return [
            'company_id'             => \Modules\Core\Models\Company::factory(),
            'client_id'              => \Modules\Clients\Models\Client::factory(),
            'invoice_group_id'       => \Modules\Core\Models\InvoiceGroup::factory(),
            'user_id'                => \Modules\Core\Models\User::factory(),
            'invoice_id'             => 0,
            'quote_status_id'        => 1,
            'quote_date_expires'     => now()->addDays(30),
            'quote_number'           => fake()->unique()->numerify('QUO-####'),
            'quote_discount_amount'  => 0,
            'quote_discount_percent' => 0,
            'quote_url_key'          => fake()->unique()->uuid(),
            'quote_date_created'     => now(),
            'quote_date_modified'    => now(),
        ];
    }
}
