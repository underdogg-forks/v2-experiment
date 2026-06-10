<?php

namespace Modules\Payments\Filament\Resources\Payments;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Payments\Filament\Resources\Payments\Pages\CreatePayment;
use Modules\Payments\Filament\Resources\Payments\Pages\EditPayment;
use Modules\Payments\Filament\Resources\Payments\Pages\ListPayments;
use Modules\Payments\Filament\Resources\Payments\Schemas\PaymentForm;
use Modules\Payments\Filament\Resources\Payments\Tables\PaymentsTable;
use Modules\Payments\Models\Payment;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PaymentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PaymentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListPayments::route('/'),
            'create' => CreatePayment::route('/create'),
            'edit'   => EditPayment::route('/{record}/edit'),
        ];
    }
}
