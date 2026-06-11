<?php

namespace Modules\Payments\Filament\Resources\Payments\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Payments\Filament\Resources\Payments\PaymentResource;
use Modules\Payments\Services\PaymentService;

class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['payment_note'] ??= '';

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        return app(PaymentService::class)->createPayment($data);
    }
}
