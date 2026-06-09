<?php

namespace App\Filament\App\Resources\Tasks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TasksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.name')
                    ->searchable(),
                TextColumn::make('project.project_id')
                    ->searchable(),
                TextColumn::make('task_name')
                    ->searchable(),
                TextColumn::make('task_price')
                    ->money()
                    ->sortable(),
                TextColumn::make('task_finish_date')
                    ->date()
                    ->sortable(),
                IconColumn::make('task_status')
                    ->boolean(),
                TextColumn::make('tax_rate.tax_rate_id')
                    ->searchable(),
            ])
            ->filters([
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
