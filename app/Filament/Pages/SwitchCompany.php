<?php

namespace App\Filament\Pages;

use App\Models\Company;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class SwitchCompany extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected string $view = 'filament.pages.switch-company';

    protected static ?string $title = 'Switch Company';

    public function table(Table $table): Table
    {
        return $table
            ->query(Auth::user()->companies())
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Company Name'),
            ])
            ->recordActions([
                Action::make('switch')
                    ->label('Switch')
                    ->action(function (Company $record) {
                        session(['current_company_id' => $record->id]);
                        // Redirect to the new company dashboard
                        redirect(route('filament.company.pages.dashboard', ['tenant' => $record->search_code]));
                    })
                    ->disabled(fn (Company $record) => $record->id === session('current_company_id')),
            ]);
    }
}
