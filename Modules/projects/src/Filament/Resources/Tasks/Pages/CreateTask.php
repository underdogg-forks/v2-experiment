<?php

namespace Modules\Projects\Filament\Resources\Tasks\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Projects\Filament\Resources\Tasks\TaskResource;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;
}
