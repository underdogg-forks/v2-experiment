<?php

namespace Modules\Quotes\Filament\Resources\Quotes\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Quotes\Filament\Resources\Quotes\QuoteResource;
use Modules\Quotes\Services\QuoteService;

class EditQuote extends EditRecord
{
    protected static string $resource = QuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return app(QuoteService::class)->updateQuote($record, $data);
    }
}
