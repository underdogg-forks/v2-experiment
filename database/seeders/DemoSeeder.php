<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Clients\Database\Seeders\ClientsSeeder;
use Modules\Core\Database\Seeders\UsersSeeder;
use Modules\Core\Models\Company;
use Modules\Expenses\Database\Seeders\ExpensesSeeder;
use Modules\Invoices\Database\Seeders\InvoicesSeeder;
use Modules\Payments\Database\Seeders\PaymentsSeeder;
use Modules\Products\Database\Seeders\ProductsSeeder;
use Modules\Projects\Database\Seeders\ProjectsSeeder;
use Modules\Projects\Database\Seeders\TasksSeeder;
use Modules\Quotes\Database\Seeders\QuotesSeeder;

class DemoSeeder extends Seeder
{
    /** @var array<string, int> */
    private array $extraVolumes = [
        'users'    => 5,
        'clients'  => 20,
        'products' => 10,
        'expenses' => 20,
        'projects' => 10,
        'tasks'    => 20,
        'quotes'   => 30,
        'invoices' => 30,
        'payments' => 10,
    ];

    public function run(): void
    {
        // Base seed first
        $this->call(DatabaseSeeder::class);

        // Top up every company with extra demo volume
        $this->command->info('Adding extra demo data…');

        $companies = Company::all();
        $bar       = $this->command->getOutput()->createProgressBar($companies->count());
        $bar->setFormat(' <comment>Demo data</comment> ▕%bar%▏ %current%/%max%  %message%');
        $bar->start();

        foreach ($companies as $company) {
            $bar->setMessage($company->name);

            $p = ['company' => $company->id];

            $this->callWith(UsersSeeder::class, $p + ['count' => $this->extraVolumes['users']]);
            $this->callWith(ClientsSeeder::class, $p + ['count' => $this->extraVolumes['clients']]);
            $this->callWith(ProductsSeeder::class, $p + ['count' => $this->extraVolumes['products']]);
            $this->callWith(ExpensesSeeder::class, $p + ['count' => $this->extraVolumes['expenses']]);
            $this->callWith(ProjectsSeeder::class, $p + ['count' => $this->extraVolumes['projects']]);
            $this->callWith(TasksSeeder::class, $p + ['count' => $this->extraVolumes['tasks']]);
            $this->callWith(QuotesSeeder::class, $p + ['count' => $this->extraVolumes['quotes']]);
            $this->callWith(InvoicesSeeder::class, $p + ['count' => $this->extraVolumes['invoices']]);
            $this->callWith(PaymentsSeeder::class, $p + ['count' => $this->extraVolumes['payments']]);

            $bar->advance();
        }

        $bar->finish();
        $this->command->newLine(2);
    }
}
