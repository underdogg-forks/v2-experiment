<?php

namespace Modules\Quotes\Filament\Resources\Quotes;

use BackedEnum;
use Modules\Core\Filament\Resources\BaseResource as Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Quotes\Filament\Resources\Quotes\Pages\CreateQuote;
use Modules\Quotes\Filament\Resources\Quotes\Pages\EditQuote;
use Modules\Quotes\Filament\Resources\Quotes\Pages\ListQuotes;
use Modules\Quotes\Filament\Resources\Quotes\Schemas\QuoteForm;
use Modules\Quotes\Filament\Resources\Quotes\Tables\QuotesTable;
use Modules\Quotes\Models\Quote;

class QuoteResource extends Resource
{
    protected static ?string $model = Quote::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return QuoteForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuotesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListQuotes::route('/'),
            'create' => CreateQuote::route('/create'),
            'edit'   => EditQuote::route('/{record}/edit'),
        ];
    }
}
