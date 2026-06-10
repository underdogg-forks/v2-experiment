<?php

namespace Modules\Expenses\Filament\Resources\Expenses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExpensesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.name')
                    ->searchable(),
                TextColumn::make('invoice.invoice_id')
                    ->searchable(),
                TextColumn::make('customer_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vendor_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('category_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('user.user_id')
                    ->searchable(),
                TextColumn::make('expense_number')
                    ->searchable(),
                TextColumn::make('expense_status')
                    ->searchable(),
                TextColumn::make('expense_type')
                    ->searchable(),
                TextColumn::make('expensed_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('expense_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('description')
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
