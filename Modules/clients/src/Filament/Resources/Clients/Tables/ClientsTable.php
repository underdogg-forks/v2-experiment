<?php

namespace Modules\Clients\Filament\Resources\Clients\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.name')
                    ->searchable(),
                TextColumn::make('client_name')
                    ->searchable(),
                TextColumn::make('client_company')
                    ->searchable(),
                TextColumn::make('client_address_1')
                    ->searchable(),
                TextColumn::make('client_address_2')
                    ->searchable(),
                TextColumn::make('client_city')
                    ->searchable(),
                TextColumn::make('client_state')
                    ->searchable(),
                TextColumn::make('client_zip')
                    ->searchable(),
                TextColumn::make('client_country')
                    ->searchable(),
                TextColumn::make('client_phone')
                    ->searchable(),
                TextColumn::make('client_fax')
                    ->searchable(),
                TextColumn::make('client_mobile')
                    ->searchable(),
                TextColumn::make('client_email')
                    ->searchable(),
                TextColumn::make('client_web')
                    ->searchable(),
                TextColumn::make('client_vat_id')
                    ->searchable(),
                TextColumn::make('client_tax_code')
                    ->searchable(),
                TextColumn::make('client_language')
                    ->searchable(),
                IconColumn::make('client_active')
                    ->boolean(),
                TextColumn::make('client_surname')
                    ->searchable(),
                TextColumn::make('client_invoicing_contact')
                    ->searchable(),
                TextColumn::make('client_title')
                    ->searchable(),
                IconColumn::make('client_einvoicing_active')
                    ->boolean(),
                TextColumn::make('client_einvoicing_version')
                    ->searchable(),
                TextColumn::make('client_avs')
                    ->searchable(),
                TextColumn::make('client_insurednumber')
                    ->searchable(),
                TextColumn::make('client_veka')
                    ->searchable(),
                TextColumn::make('client_birthdate')
                    ->date()
                    ->sortable(),
                TextColumn::make('client_gender')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('client_date_created')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('client_date_modified')
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
