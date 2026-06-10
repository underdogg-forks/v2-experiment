<?php

namespace Modules\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Core\Models\Company;
use Modules\Core\Models\InvoiceGroup;

class InvoiceGroupFactory extends Factory
{
    protected $model = InvoiceGroup::class;

    public function definition(): array
    {
        return [
            'company_id'                      => Company::factory(),
            'invoice_group_name'              => fake()->words(2, true),
            'invoice_group_identifier_format' => '{YYYY}-{NUM}',
            'invoice_group_next_id'           => 1,
            'invoice_group_left_pad'          => 4,
        ];
    }
}
