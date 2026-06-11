<?php

namespace Modules\Projects\Filament\Resources\Tasks\Schemas;

use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Modules\Core\Models\TaxRate;
use Modules\Projects\Models\Project;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project_id')
                    ->options(fn () => Project::query()
                        ->where('company_id', Filament::getTenant()?->id)
                        ->pluck('project_name', 'project_id'))
                    ->required(),
                TextInput::make('task_name')
                    ->default(null),
                Textarea::make('task_description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('task_price')
                    ->numeric()
                    ->default(null)
                    ->prefix('$'),
                DatePicker::make('task_finish_date')
                    ->default(null),
                Toggle::make('task_status')
                    ->default(false),
                Select::make('tax_rate_id')
                    ->options(fn () => TaxRate::query()
                        ->where('company_id', Filament::getTenant()?->id)
                        ->pluck('tax_rate_name', 'tax_rate_id'))
                    ->default(null),
            ]);
    }
}
