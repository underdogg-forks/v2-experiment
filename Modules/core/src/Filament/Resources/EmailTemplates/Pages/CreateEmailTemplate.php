<?php

namespace Modules\Core\Filament\Resources\EmailTemplates\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Core\Filament\Resources\EmailTemplates\EmailTemplateResource;

class CreateEmailTemplate extends CreateRecord
{
    protected static string $resource = EmailTemplateResource::class;
}
