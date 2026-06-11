<?php

namespace Modules\Core\Filament\Resources\TaxRates\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Filament\Resources\TaxRates\TaxRateResource;
use Modules\Core\Services\TaxRateService;

class EditTaxRate extends EditRecord
{
    protected static string $resource = TaxRateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return app(TaxRateService::class)->updateTaxRate($record, $data);
    }
}
