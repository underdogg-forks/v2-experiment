<?php

namespace App\Filament\App\Resources\Invoices\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InvoicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.name')
                    ->searchable(),
                TextColumn::make('client.client_id')
                    ->searchable(),
                TextColumn::make('invoice_group.invoice_group_id')
                    ->searchable(),
                TextColumn::make('user.user_id')
                    ->searchable(),
                TextColumn::make('invoice_status_id')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_read_only')
                    ->boolean(),
                TextColumn::make('invoice_date_created')
                    ->date()
                    ->sortable(),
                TextColumn::make('invoice_time_created')
                    ->time()
                    ->sortable(),
                TextColumn::make('invoice_date_modified')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('invoice_date_due')
                    ->date()
                    ->sortable(),
                TextColumn::make('invoice_number')
                    ->searchable(),
                TextColumn::make('invoice_discount_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('invoice_discount_percent')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('invoice_url_key')
                    ->searchable(),
                TextColumn::make('payment_method')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('creditinvoice_parent_id')
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
