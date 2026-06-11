<?php

namespace Modules\Core\Filament\Resources\EmailTemplates\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Filament\Resources\EmailTemplates\EmailTemplateResource;
use Modules\Core\Services\EmailTemplateService;

class EditEmailTemplate extends EditRecord
{
    protected static string $resource = EmailTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return app(EmailTemplateService::class)->updateEmailTemplate($record, $data);
    }
}
