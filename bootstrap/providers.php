<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    App\Providers\Filament\CompanyPanelProvider::class,
    Modules\Clients\Providers\ClientsServiceProvider::class,
    Modules\Core\Providers\CoreServiceProvider::class,
    Modules\Expenses\Providers\ExpensesServiceProvider::class,
    Modules\Invoices\Providers\InvoicesServiceProvider::class,
    Modules\Payments\Providers\PaymentsServiceProvider::class,
    Modules\Products\Providers\ProductsServiceProvider::class,
    Modules\Projects\Providers\ProjectsServiceProvider::class,
    Modules\Quotes\Providers\QuotesServiceProvider::class,
];
