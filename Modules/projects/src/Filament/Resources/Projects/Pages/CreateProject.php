<?php

namespace Modules\Projects\Filament\Resources\Projects\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Projects\Filament\Resources\Projects\ProjectResource;
use Modules\Projects\Services\ProjectService;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return app(ProjectService::class)->createProject($data);
    }
}
