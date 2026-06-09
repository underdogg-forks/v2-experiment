<?php

namespace App\Filament\App\Resources\EmailTemplates\Pages;

use App\Filament\App\Resources\EmailTemplates\EmailTemplateResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEmailTemplate extends CreateRecord
{
    protected static string $resource = EmailTemplateResource::class;
}
