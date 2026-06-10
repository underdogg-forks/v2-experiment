<?php

namespace Modules\Projects\Filament\Resources\Projects;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Projects\Filament\Resources\Projects\Pages\CreateProject;
use Modules\Projects\Filament\Resources\Projects\Pages\EditProject;
use Modules\Projects\Filament\Resources\Projects\Pages\ListProjects;
use Modules\Projects\Filament\Resources\Projects\Schemas\ProjectForm;
use Modules\Projects\Filament\Resources\Projects\Tables\ProjectsTable;
use Modules\Projects\Models\Project;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ProjectForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'edit'   => EditProject::route('/{record}/edit'),
        ];
    }
}
