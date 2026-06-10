<?php

namespace Modules\Core\Filament\Resources\EmailTemplates;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Core\Filament\Resources\EmailTemplates\Pages\CreateEmailTemplate;
use Modules\Core\Filament\Resources\EmailTemplates\Pages\EditEmailTemplate;
use Modules\Core\Filament\Resources\EmailTemplates\Pages\ListEmailTemplates;
use Modules\Core\Filament\Resources\EmailTemplates\Schemas\EmailTemplateForm;
use Modules\Core\Filament\Resources\EmailTemplates\Tables\EmailTemplatesTable;
use Modules\Core\Models\EmailTemplate;

class EmailTemplateResource extends Resource
{
    protected static ?string $model = EmailTemplate::class;

    public static function isScopedToTenant(): bool
    {
        return false;
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return EmailTemplateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmailTemplatesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListEmailTemplates::route('/'),
            'create' => CreateEmailTemplate::route('/create'),
            'edit'   => EditEmailTemplate::route('/{record}/edit'),
        ];
    }
}
