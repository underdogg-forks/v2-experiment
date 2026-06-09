<?php

namespace App\Filament\App\Resources\TaxRates\Pages;

use App\Filament\App\Resources\TaxRates\TaxRateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

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
