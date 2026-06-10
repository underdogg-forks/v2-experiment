<?php

namespace Modules\Core\Filament\Resources\InvoiceGroups\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InvoiceGroupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('invoice_group_name')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('invoice_group_identifier_format')
                    ->required(),
                TextInput::make('invoice_group_next_id')
                    ->required()
                    ->numeric(),
                TextInput::make('invoice_group_left_pad')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
