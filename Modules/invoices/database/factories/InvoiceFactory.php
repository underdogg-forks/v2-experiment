<?php

namespace Modules\Invoices\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Clients\Models\Client;
use Modules\Core\Models\Company;
use Modules\Core\Models\InvoiceGroup;
use Modules\Core\Models\User;
use Modules\Invoices\Models\Invoice;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        return [
            'company_id'               => Company::factory(),
            'client_id'                => Client::factory(),
            'invoice_group_id'         => InvoiceGroup::factory(),
            'user_id'                  => User::factory(),
            'invoice_status_id'        => 1,
            'is_read_only'             => false,
            'invoice_date_created'     => now()->toDateString(),
            'invoice_time_created'     => now()->toTimeString(),
            'invoice_date_modified'    => now(),
            'invoice_date_due'         => now()->addDays(30)->toDateString(),
            'invoice_number'           => fake()->unique()->numerify('INV-####'),
            'invoice_discount_amount'  => 0,
            'invoice_discount_percent' => 0,
            'invoice_terms'            => '',
            'invoice_url_key'          => fake()->unique()->uuid(),
            'payment_method'           => 0,
        ];
    }
}
