<?php

namespace App\Filament\App\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_type')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('user_active')
                    ->boolean(),
                TextColumn::make('user_date_created')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('user_date_modified')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('user_language')
                    ->searchable(),
                TextColumn::make('user_name')
                    ->searchable(),
                TextColumn::make('user_company')
                    ->searchable(),
                TextColumn::make('user_address_1')
                    ->searchable(),
                TextColumn::make('user_address_2')
                    ->searchable(),
                TextColumn::make('user_city')
                    ->searchable(),
                TextColumn::make('user_state')
                    ->searchable(),
                TextColumn::make('user_zip')
                    ->searchable(),
                TextColumn::make('user_country')
                    ->searchable(),
                TextColumn::make('user_invoicing_contact')
                    ->searchable(),
                TextColumn::make('user_phone')
                    ->searchable(),
                TextColumn::make('user_fax')
                    ->searchable(),
                TextColumn::make('user_mobile')
                    ->searchable(),
                TextColumn::make('user_email')
                    ->searchable(),
                TextColumn::make('user_web')
                    ->searchable(),
                TextColumn::make('user_vat_id')
                    ->searchable(),
                TextColumn::make('user_tax_code')
                    ->searchable(),
                TextColumn::make('user_psalt')
                    ->searchable(),
                IconColumn::make('user_all_clients')
                    ->boolean(),
                TextColumn::make('user_subscribernumber')
                    ->searchable(),
                TextColumn::make('user_bank')
                    ->searchable(),
                TextColumn::make('user_iban')
                    ->searchable(),
                TextColumn::make('user_bic')
                    ->searchable(),
                TextColumn::make('user_remittance_text')
                    ->searchable(),
                TextColumn::make('user_gln')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('user_rcc')
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
