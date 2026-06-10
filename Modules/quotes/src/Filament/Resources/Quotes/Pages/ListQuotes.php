<?php

namespace Modules\Quotes\Filament\Resources\Quotes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Quotes\Filament\Resources\Quotes\QuoteResource;

class ListQuotes extends ListRecords
{
    protected static string $resource = QuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
