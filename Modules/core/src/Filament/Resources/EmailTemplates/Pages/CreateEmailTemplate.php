<?php

namespace Modules\Core\Filament\Resources\EmailTemplates\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Filament\Resources\EmailTemplates\EmailTemplateResource;
use Modules\Core\Services\EmailTemplateService;

class CreateEmailTemplate extends CreateRecord
{
    protected static string $resource = EmailTemplateResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return app(EmailTemplateService::class)->createEmailTemplate($data);
    }
}
