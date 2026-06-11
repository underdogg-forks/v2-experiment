<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Clients\Database\Seeders\ClientsSeeder;
use Modules\Core\Database\Seeders\UsersSeeder;
use Modules\Core\Enums\UserRole;
use Modules\Core\Models\Company;
use Modules\Core\Models\User;
use Modules\Expenses\Database\Seeders\ExpensesSeeder;
use Modules\Invoices\Database\Seeders\InvoicesSeeder;
use Modules\Payments\Database\Seeders\PaymentsSeeder;
use Modules\Products\Database\Seeders\ProductsSeeder;
use Modules\Projects\Database\Seeders\ProjectsSeeder;
use Modules\Projects\Database\Seeders\TasksSeeder;
use Modules\Quotes\Database\Seeders\QuotesSeeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /** @var array<string, int> */
    private array $volumes = [
        'users'    => 10,
        'clients'  => 15,
        'products' => 15,
        'expenses' => 15,
        'projects' => 15,
        'tasks'    => 25,
        'quotes'   => 25,
        'invoices' => 25,
        'payments' => 15,
    ];

    private int $companyCount = 10;

    public function run(): void
    {
        $this->seedRoles();
        $this->seedSuperAdmin();
        $this->seedCompanies();
    }

    private function seedRoles(): void
    {
        $this->command->info('Seeding roles…');

        foreach (UserRole::cases() as $role) {
            Role::firstOrCreate(
                ['name' => $role->value],
                ['guard_name' => 'web'],
            );
        }
    }

    private function seedSuperAdmin(): void
    {
        $this->command->info('Seeding super admin…');

        /** @var User $superAdmin */
        $superAdmin = User::factory()->create([
            'user_name'   => 'Super Admin',
            'user_email'  => 'superadmin@example.com',
            'user_active' => true,
        ]);

        $superAdmin->assignRole(UserRole::SUPER_ADMIN->value);
    }

    private function seedCompanies(): void
    {
        $this->command->info("Seeding {$this->companyCount} companies…");

        $companies = Company::factory()->count($this->companyCount)->create();

        $bar = $this->command->getOutput()->createProgressBar($companies->count());
        $bar->setFormat(' <comment>Companies</comment> ▕%bar%▏ %current%/%max%  %message%');
        $bar->start();

        foreach ($companies as $company) {
            $bar->setMessage($company->name);

            $p = ['company' => $company->id];

            $this->callWith(UsersSeeder::class, $p + ['count' => $this->volumes['users']]);
            $this->callWith(ClientsSeeder::class, $p + ['count' => $this->volumes['clients']]);
            $this->callWith(ProductsSeeder::class, $p + ['count' => $this->volumes['products']]);
            $this->callWith(ExpensesSeeder::class, $p + ['count' => $this->volumes['expenses']]);
            $this->callWith(ProjectsSeeder::class, $p + ['count' => $this->volumes['projects']]);
            $this->callWith(TasksSeeder::class, $p + ['count' => $this->volumes['tasks']]);
            $this->callWith(QuotesSeeder::class, $p + ['count' => $this->volumes['quotes']]);
            $this->callWith(InvoicesSeeder::class, $p + ['count' => $this->volumes['invoices']]);
            $this->callWith(PaymentsSeeder::class, $p + ['count' => $this->volumes['payments']]);

            $bar->advance();
        }

        $bar->finish();
        $this->command->newLine(2);
    }
}
