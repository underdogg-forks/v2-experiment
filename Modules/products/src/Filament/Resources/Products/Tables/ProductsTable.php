<?php

namespace Modules\Products\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.name')
                    ->searchable(),
                TextColumn::make('family.family_id')
                    ->searchable(),
                TextColumn::make('product_sku')
                    ->searchable(),
                TextColumn::make('product_name')
                    ->searchable(),
                TextColumn::make('product_price')
                    ->money()
                    ->sortable(),
                TextColumn::make('purchase_price')
                    ->money()
                    ->sortable(),
                TextColumn::make('provider_name')
                    ->searchable(),
                TextColumn::make('tax_rate.tax_rate_id')
                    ->searchable(),
                TextColumn::make('unit.unit_id')
                    ->searchable(),
                TextColumn::make('product_tariff')
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
