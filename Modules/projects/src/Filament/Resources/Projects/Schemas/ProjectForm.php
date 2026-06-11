<?php

namespace Modules\Projects\Filament\Resources\Projects\Schemas;

use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Modules\Clients\Models\Client;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('client_id')
                    ->options(fn () => Client::query()
                        ->where('company_id', Filament::getTenant()?->id)
                        ->pluck('client_name', 'client_id'))
                    ->searchable()
                    ->required(),
                Textarea::make('project_name')
                    ->required()
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
