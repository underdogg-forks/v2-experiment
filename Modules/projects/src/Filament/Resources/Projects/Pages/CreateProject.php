<?php

namespace Modules\Projects\Filament\Resources\Projects\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Projects\Filament\Resources\Projects\ProjectResource;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;
}
