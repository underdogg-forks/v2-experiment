<?php

namespace Modules\Core\Filament\Resources\EmailTemplates\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmailTemplateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('email_template_title')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('email_template_type')
                    ->required(),
                Textarea::make('email_template_body')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('email_template_subject')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('email_template_from_name')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('email_template_from_email')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('email_template_cc')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('email_template_bcc')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('email_template_pdf_template')
                    ->default(null),
            ]);
    }
}
