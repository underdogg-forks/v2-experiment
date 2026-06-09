<?php

namespace App\Filament\App\Resources\EmailTemplates\Pages;

use App\Filament\App\Resources\EmailTemplates\EmailTemplateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEmailTemplate extends EditRecord
{
    protected static string $resource = EmailTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
