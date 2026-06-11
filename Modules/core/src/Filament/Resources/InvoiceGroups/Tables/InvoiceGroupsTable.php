<?php

namespace Modules\Core\Filament\Resources\InvoiceGroups\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InvoiceGroupsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_group_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('invoice_group_identifier_format')
                    ->searchable(),
                TextColumn::make('invoice_group_next_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('invoice_group_left_pad')
                    ->numeric()
                    ->sortable(),
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
