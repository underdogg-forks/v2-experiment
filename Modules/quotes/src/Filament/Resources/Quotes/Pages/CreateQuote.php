<?php

namespace Modules\Quotes\Filament\Resources\Quotes\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Quotes\Filament\Resources\Quotes\QuoteResource;

class CreateQuote extends CreateRecord
{
    protected static string $resource = QuoteResource::class;
}
