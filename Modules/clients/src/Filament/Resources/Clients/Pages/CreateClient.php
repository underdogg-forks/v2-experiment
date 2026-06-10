<?php

namespace Modules\Clients\Filament\Resources\Clients\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Clients\Filament\Resources\Clients\ClientResource;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;
}
