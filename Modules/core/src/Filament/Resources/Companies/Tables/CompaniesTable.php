<?php

namespace Modules\Core\Filament\Resources\Companies\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CompaniesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('search_code')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('vat_number')
                    ->searchable(),
                TextColumn::make('id_number')
                    ->searchable(),
                TextColumn::make('coc_number')
                    ->searchable(),
                TextColumn::make('logo')
                    ->searchable(),
                TextColumn::make('quote_template')
                    ->searchable(),
                TextColumn::make('invoice_template')
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
