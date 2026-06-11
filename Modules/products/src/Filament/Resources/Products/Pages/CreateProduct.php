<?php

namespace Modules\Products\Filament\Resources\Products\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Products\Filament\Resources\Products\ProductResource;
use Modules\Products\Services\ProductService;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['product_description'] ??= '';

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        return app(ProductService::class)->createProduct($data);
    }
}
