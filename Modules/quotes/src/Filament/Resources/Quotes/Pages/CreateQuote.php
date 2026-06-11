<?php

namespace Modules\Quotes\Filament\Resources\Quotes\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Quotes\Filament\Resources\Quotes\QuoteResource;
use Modules\Quotes\Services\QuoteService;

class CreateQuote extends CreateRecord
{
    protected static string $resource = QuoteResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return app(QuoteService::class)->createQuote($data);
    }
}
