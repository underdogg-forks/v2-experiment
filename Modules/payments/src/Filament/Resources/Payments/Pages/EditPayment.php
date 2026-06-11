<?php

namespace Modules\Payments\Filament\Resources\Payments\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Payments\Filament\Resources\Payments\PaymentResource;
use Modules\Payments\Services\PaymentService;

class EditPayment extends EditRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return app(PaymentService::class)->updatePayment($record, $data);
    }
}
