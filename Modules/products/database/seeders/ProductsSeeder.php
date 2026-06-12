<?php

namespace Modules\Products\Database\Seeders;

use Modules\Core\Database\Seeders\AbstractSeeder;
use Modules\Products\Models\Product;

class ProductsSeeder extends AbstractSeeder
{
    protected string $label = 'Products';

    protected int $defaultCount = 15;

    protected function buildOne(): void
    {
        $family  = $this->findOrCreateFamily($this->companyId);
        $taxRate = $this->findOrCreateTaxRate($this->companyId);

        Product::factory()->create([
            'company_id'  => $this->companyId,
            'family_id'   => $family->family_id,
            'tax_rate_id' => $taxRate->tax_rate_id,
        ]);
    }
}
