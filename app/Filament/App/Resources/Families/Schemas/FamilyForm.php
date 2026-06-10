<?php

namespace App\Filament\App\Resources\Families\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FamilyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('family_name')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
