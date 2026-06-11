<?php

namespace Modules\Quotes\Filament\Resources\Quotes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuotesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.name')
                    ->searchable(),
                TextColumn::make('invoice_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('user.user_id')
                    ->searchable(),
                TextColumn::make('client.client_id')
                    ->searchable(),
                TextColumn::make('invoice_group.invoice_group_id')
                    ->searchable(),
                TextColumn::make('quote_status_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('quote_date_expires')
                    ->date()
                    ->sortable(),
                TextColumn::make('quote_number')
                    ->searchable(),
                TextColumn::make('quote_discount_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('quote_discount_percent')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('quote_url_key')
                    ->searchable(),
                TextColumn::make('quote_date_created')
                    ->date()
                    ->sortable(),
                TextColumn::make('quote_date_modified')
                    ->dateTime()
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
