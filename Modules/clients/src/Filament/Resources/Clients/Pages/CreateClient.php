<?php

namespace Modules\Clients\Filament\Resources\Clients\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Clients\Filament\Resources\Clients\ClientResource;
use Modules\Clients\Services\ClientService;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return app(ClientService::class)->createClient($data);
    }
}
