<?php

namespace Modules\Quotes\Filament\Resources\Quotes\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Quotes\Filament\Resources\Quotes\QuoteResource;

class EditQuote extends EditRecord
{
    protected static string $resource = QuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
