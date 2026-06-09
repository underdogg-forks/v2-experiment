<?php

namespace App\Livewire;

use App\Models\Company;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SwitchCompany extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Auth::user()->companies())
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Company Name'),
            ])
            ->actions([
                Tables\Actions\Action::make('switch')
                    ->label('Switch')
                    ->action(function (Company $record) {
                        session(['current_company_id' => $record->id]);
                        // Redirect to the new company dashboard
                        redirect(route('filament.company.pages.dashboard', ['tenant' => $record->search_code]));
                    })
                    ->disabled(fn (Company $record) => $record->id === session('current_company_id')),
            ]);
    }

    public function render()
    {
        return view('livewire.switch-company');
    }
}
