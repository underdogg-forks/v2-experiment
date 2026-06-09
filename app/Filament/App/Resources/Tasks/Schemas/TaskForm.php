<?php

namespace App\Filament\App\Resources\Tasks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                Select::make('project_id')
                    ->relationship('project', 'project_id')
                    ->required(),
                TextInput::make('task_name')
                    ->default(null),
                Textarea::make('task_description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('task_price')
                    ->numeric()
                    ->default(null)
                    ->prefix('$'),
                DatePicker::make('task_finish_date')
                    ->required(),
                Toggle::make('task_status')
                    ->required(),
                Select::make('tax_rate_id')
                    ->relationship('tax_rate', 'tax_rate_id')
                    ->required(),
            ]);
    }
}
