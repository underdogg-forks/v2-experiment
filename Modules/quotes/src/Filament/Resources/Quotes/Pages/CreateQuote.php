<?php

namespace Modules\Quotes\Filament\Resources\Quotes\Pages;

use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Quotes\Filament\Resources\Quotes\QuoteResource;
use Modules\Quotes\Services\QuoteService;

class CreateQuote extends CreateRecord
{
    protected static string $resource = QuoteResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] ??= Filament::auth()->user()?->getKey();
        $data['quote_date_expires'] ??= now()->addDays(30)->toDateString();
        $data['quote_date_created'] ??= now()->toDateString();
        $data['quote_date_modified'] ??= now();
        $data['quote_url_key'] ??= \Illuminate\Support\Str::random(32);

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        return app(QuoteService::class)->createQuote($data);
    }
}
