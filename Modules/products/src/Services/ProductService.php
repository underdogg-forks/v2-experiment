<?php

namespace Modules\Products\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Products\Models\Product;

class ProductService
{
    public function createProduct(array $data): Product
    {
        return Product::query()->create($data);
    }

    public function updateProduct(Product $product, array $data): Product
    {
        $product->update($data);

        return $product->fresh();
    }

    public function deleteProduct(Product $product): bool
    {
        return (bool) $product->delete();
    }

    public function listForCompany(int $companyId): Collection
    {
        return Product::query()
            ->where('company_id', $companyId)
            ->with(['family', 'tax_rate', 'unit'])
            ->orderBy('product_name')
            ->get();
    }
}
