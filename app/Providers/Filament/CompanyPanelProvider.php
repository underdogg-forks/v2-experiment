<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use App\Http\Middleware\ConfigureTenant;
use App\Http\Middleware\EnsureUserCanAccessCompany;
use App\Http\Middleware\SetTenantFromQueryString;
use App\Models\Company;
use Filament\Actions\Action;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Enums\Width;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class CompanyPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('company')
            ->path('')
            ->viteTheme('resources/css/filament/company/nord.css')
            ->login(Login::class)
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->maxContentWidth(Width::Full)
            ->tenant(Company::class)
            ->font('Poppins', provider: GoogleFontProvider::class)
            ->unsavedChangesAlerts()
            ->sidebarCollapsibleOnDesktop()
            ->tenantMenu(false)
            // ->tenantRegistration(RegisterCompany::class)
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\App\\Widgets')
            ->tenantMiddleware([
                SetTenantFromQueryString::class,
                ConfigureTenant::class,
                EnsureUserCanAccessCompany::class,
            ], isPersistent: true)
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->userMenuItems([
                Action::make('switch-company')
                    ->label('Switch Company')
                    ->icon('heroicon-o-building-office-2')
                    ->modalHeading('Switch Company')
                    ->modalContent(fn () => view('filament.company.widgets.switch-company-table')),
                'logout' => fn (Action $action) => $action
                    ->label(trans('ip.logout'))
                    ->icon('heroicon-o-arrow-right-start-on-rectangle'),
            ]);
    }
}
