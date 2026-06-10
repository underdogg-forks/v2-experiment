<?php

namespace Modules\Core\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                TextInput::make('setting_key')
                    ->required(),
                Textarea::make('setting_value')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
