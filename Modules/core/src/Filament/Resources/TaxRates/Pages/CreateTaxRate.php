<?php

namespace Modules\Core\Filament\Resources\TaxRates\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Core\Filament\Resources\TaxRates\TaxRateResource;

class CreateTaxRate extends CreateRecord
{
    protected static string $resource = TaxRateResource::class;
}
