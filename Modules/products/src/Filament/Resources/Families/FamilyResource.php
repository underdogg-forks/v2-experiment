<?php

namespace Modules\Products\Filament\Resources\Families;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Products\Filament\Resources\Families\Pages\CreateFamily;
use Modules\Products\Filament\Resources\Families\Pages\EditFamily;
use Modules\Products\Filament\Resources\Families\Pages\ListFamilies;
use Modules\Products\Filament\Resources\Families\Schemas\FamilyForm;
use Modules\Products\Filament\Resources\Families\Tables\FamiliesTable;
use Modules\Products\Models\Family;

class FamilyResource extends Resource
{
    protected static ?string $model = Family::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return FamilyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FamiliesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListFamilies::route('/'),
            'create' => CreateFamily::route('/create'),
            'edit'   => EditFamily::route('/{record}/edit'),
        ];
    }
}
