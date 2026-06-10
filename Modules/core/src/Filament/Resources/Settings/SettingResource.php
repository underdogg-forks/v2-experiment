<?php

namespace Modules\Core\Filament\Resources\Settings;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Core\Filament\Resources\Settings\Pages\CreateSetting;
use Modules\Core\Filament\Resources\Settings\Pages\EditSetting;
use Modules\Core\Filament\Resources\Settings\Pages\ListSettings;
use Modules\Core\Filament\Resources\Settings\Schemas\SettingForm;
use Modules\Core\Filament\Resources\Settings\Tables\SettingsTable;
use Modules\Core\Models\Setting;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return SettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListSettings::route('/'),
            'create' => CreateSetting::route('/create'),
            'edit'   => EditSetting::route('/{record}/edit'),
        ];
    }
}
