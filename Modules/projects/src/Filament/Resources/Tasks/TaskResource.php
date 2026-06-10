<?php

namespace Modules\Projects\Filament\Resources\Tasks;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Projects\Filament\Resources\Tasks\Pages\CreateTask;
use Modules\Projects\Filament\Resources\Tasks\Pages\EditTask;
use Modules\Projects\Filament\Resources\Tasks\Pages\ListTasks;
use Modules\Projects\Filament\Resources\Tasks\Schemas\TaskForm;
use Modules\Projects\Filament\Resources\Tasks\Tables\TasksTable;
use Modules\Projects\Models\Task;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TaskForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TasksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListTasks::route('/'),
            'create' => CreateTask::route('/create'),
            'edit'   => EditTask::route('/{record}/edit'),
        ];
    }
}
