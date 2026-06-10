<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as FilamentLogin;

class Login extends FilamentLogin
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'email'    => 'admin@admin.com',
            'password' => 'admin123',
            'remember' => true,
        ]);
    }
}
