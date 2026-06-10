<?php

namespace Modules\Payments\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Payments\Models\Payment;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'company_id'        => \Modules\Core\Models\Company::factory(),
            'invoice_id'        => \Modules\Invoices\Models\Invoice::factory(),
            'payment_method_id' => 1,
            'payment_date'      => now(),
            'payment_amount'    => fake()->randomFloat(2, 10, 1000),
            'payment_note'      => fake()->optional()->sentence(),
        ];
    }
}
