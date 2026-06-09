<?php

namespace App\Filament\App\Resources\Quotes\Pages;

use App\Filament\App\Resources\Quotes\QuoteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateQuote extends CreateRecord
{
    protected static string $resource = QuoteResource::class;
}
