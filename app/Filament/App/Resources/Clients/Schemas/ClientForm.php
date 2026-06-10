<?php

namespace App\Filament\App\Resources\Clients\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                TextInput::make('client_name')
                    ->default(null),
                TextInput::make('client_company')
                    ->default(null),
                TextInput::make('client_address_1')
                    ->default(null),
                TextInput::make('client_address_2')
                    ->default(null),
                TextInput::make('client_city')
                    ->default(null),
                TextInput::make('client_state')
                    ->default(null),
                TextInput::make('client_zip')
                    ->default(null),
                TextInput::make('client_country')
                    ->default(null),
                TextInput::make('client_phone')
                    ->tel()
                    ->default(null),
                TextInput::make('client_fax')
                    ->default(null),
                TextInput::make('client_mobile')
                    ->default(null),
                TextInput::make('client_email')
                    ->email()
                    ->default(null),
                TextInput::make('client_web')
                    ->default(null),
                TextInput::make('client_vat_id')
                    ->default(null),
                TextInput::make('client_tax_code')
                    ->default(null),
                TextInput::make('client_language')
                    ->default('system'),
                Toggle::make('client_active')
                    ->required(),
                TextInput::make('client_surname')
                    ->default(null),
                TextInput::make('client_invoicing_contact')
                    ->default(null),
                TextInput::make('client_title')
                    ->default(null),
                Toggle::make('client_einvoicing_active')
                    ->required(),
                TextInput::make('client_einvoicing_version')
                    ->default(null),
                TextInput::make('client_avs')
                    ->default(null),
                TextInput::make('client_insurednumber')
                    ->default(null),
                TextInput::make('client_veka')
                    ->default(null),
                DatePicker::make('client_birthdate'),
                TextInput::make('client_gender')
                    ->numeric()
                    ->default(0),
                DateTimePicker::make('client_date_created')
                    ->required(),
                DateTimePicker::make('client_date_modified')
                    ->required(),
            ]);
    }
}
