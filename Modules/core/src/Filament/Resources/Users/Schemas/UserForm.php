<?php

namespace Modules\Core\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_type')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('user_active'),
                DateTimePicker::make('user_date_created')
                    ->required(),
                DateTimePicker::make('user_date_modified')
                    ->required(),
                TextInput::make('user_language')
                    ->default('system'),
                TextInput::make('user_name')
                    ->default(null),
                TextInput::make('user_company')
                    ->default(null),
                TextInput::make('user_address_1')
                    ->default(null),
                TextInput::make('user_address_2')
                    ->default(null),
                TextInput::make('user_city')
                    ->default(null),
                TextInput::make('user_state')
                    ->default(null),
                TextInput::make('user_zip')
                    ->default(null),
                TextInput::make('user_country')
                    ->default(null),
                TextInput::make('user_invoicing_contact')
                    ->default(null),
                TextInput::make('user_phone')
                    ->tel()
                    ->default(null),
                TextInput::make('user_fax')
                    ->default(null),
                TextInput::make('user_mobile')
                    ->default(null),
                TextInput::make('user_email')
                    ->email()
                    ->default(null),
                TextInput::make('user_password')
                    ->password()
                    ->required(),
                TextInput::make('user_web')
                    ->default(null),
                TextInput::make('user_vat_id')
                    ->default(null),
                TextInput::make('user_tax_code')
                    ->default(null),
                TextInput::make('user_psalt')
                    ->default(null),
                Toggle::make('user_all_clients')
                    ->required(),
                TextInput::make('user_subscribernumber')
                    ->default(null),
                TextInput::make('user_bank')
                    ->default(null),
                TextInput::make('user_iban')
                    ->default(null),
                TextInput::make('user_bic')
                    ->default(null),
                TextInput::make('user_remittance_text')
                    ->default(null),
                TextInput::make('user_gln')
                    ->numeric()
                    ->default(null),
                TextInput::make('user_rcc')
                    ->default(null),
            ]);
    }
}
