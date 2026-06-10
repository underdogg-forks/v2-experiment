<?php

namespace Modules\Core\Filament\Resources\TaxRates\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Core\Filament\Resources\TaxRates\TaxRateResource;

class ListTaxRates extends ListRecords
{
    protected static string $resource = TaxRateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
