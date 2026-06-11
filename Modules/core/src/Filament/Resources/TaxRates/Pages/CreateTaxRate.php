<?php

namespace Modules\Core\Filament\Resources\TaxRates\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Filament\Resources\TaxRates\TaxRateResource;
use Modules\Core\Services\TaxRateService;

class CreateTaxRate extends CreateRecord
{
    protected static string $resource = TaxRateResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return app(TaxRateService::class)->createTaxRate($data);
    }
}
