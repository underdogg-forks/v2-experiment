<?php

namespace Modules\Projects\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                Select::make('client_id')
                    ->relationship('client', 'client_id')
                    ->required(),
                Textarea::make('project_name')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
