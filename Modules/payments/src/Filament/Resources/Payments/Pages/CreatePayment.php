<?php

namespace Modules\Payments\Filament\Resources\Payments\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Payments\Filament\Resources\Payments\PaymentResource;

class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;
}
