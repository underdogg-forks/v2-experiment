<?php

namespace Modules\Core\Filament\Resources\Companies;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Core\Filament\Resources\Companies\Pages\CreateCompany;
use Modules\Core\Filament\Resources\Companies\Pages\EditCompany;
use Modules\Core\Filament\Resources\Companies\Pages\ListCompanies;
use Modules\Core\Filament\Resources\Companies\Schemas\CompanyForm;
use Modules\Core\Filament\Resources\Companies\Tables\CompaniesTable;
use Modules\Core\Models\Company;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CompanyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompaniesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListCompanies::route('/'),
            'create' => CreateCompany::route('/create'),
            'edit'   => EditCompany::route('/{record}/edit'),
        ];
    }
}
