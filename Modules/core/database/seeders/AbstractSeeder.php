<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Clients\Models\Client;
use Modules\Core\Models\Company;
use Modules\Core\Models\InvoiceGroup;
use Modules\Core\Models\TaxRate;
use Modules\Core\Models\User;
use Modules\Expenses\Models\ExpenseCategory;
use Modules\Invoices\Models\Invoice;
use Modules\Products\Models\Family;
use Modules\Products\Models\Product;
use Modules\Projects\Models\Project;
use Modules\Projects\Models\Task;

abstract class AbstractSeeder extends Seeder
{
    protected ?int $companyId = null;

    protected int $count = 0;

    protected string $label = '';

    protected int $defaultCount = 10;

    abstract protected function buildOne(): void;

    public function run(int $company = 0, int $count = 0): void
    {
        $this->companyId = $company ?: null;
        $this->count     = $count ?: $this->defaultCount;

        if ( ! $this->companyId) {
            $this->command->warn(static::class . ' skipped (no company id)');

            return;
        }

        $this->beforeSeed();
        $this->seedWithProgress();
        $this->afterSeed();
    }

    protected function beforeSeed(): void {}

    protected function afterSeed(): void {}

    protected function company(): Company
    {
        return Company::query()->findOrFail($this->companyId);
    }

    protected function findOrCreateClient(int $companyId): Client
    {
        /** @var Client|null $client */
        $client = Client::query()->where('company_id', $companyId)->inRandomOrder()->first();

        if ( ! $client) {
            /** @var Client $client */
            $client = Client::factory()->create(['company_id' => $companyId]);
        }

        return $client;
    }

    protected function findOrCreateInvoiceGroup(int $companyId): InvoiceGroup
    {
        /** @var InvoiceGroup|null $group */
        $group = InvoiceGroup::query()->where('company_id', $companyId)->inRandomOrder()->first();

        if ( ! $group) {
            /** @var InvoiceGroup $group */
            $group = InvoiceGroup::factory()->create(['company_id' => $companyId]);
        }

        return $group;
    }

    protected function findOrCreateExpenseCategory(int $companyId): ExpenseCategory
    {
        /** @var ExpenseCategory|null $category */
        $category = ExpenseCategory::query()->where('company_id', $companyId)->inRandomOrder()->first();

        if ( ! $category) {
            /** @var ExpenseCategory $category */
            $category = ExpenseCategory::factory()->create(['company_id' => $companyId]);
        }

        return $category;
    }

    protected function findOrCreateInvoice(int $companyId): Invoice
    {
        /** @var Invoice|null $invoice */
        $invoice = Invoice::query()->where('company_id', $companyId)->inRandomOrder()->first();

        if ( ! $invoice) {
            $group  = $this->findOrCreateInvoiceGroup($companyId);
            $client = $this->findOrCreateClient($companyId);
            $user   = $this->findOrCreateUser($companyId);

            /** @var Invoice $invoice */
            $invoice = Invoice::factory()->create([
                'company_id'       => $companyId,
                'invoice_group_id' => $group->invoice_group_id,
                'client_id'        => $client->client_id,
                'user_id'          => $user->user_id,
            ]);
        }

        return $invoice;
    }

    protected function findOrCreateProduct(int $companyId): Product
    {
        /** @var Product|null $product */
        $product = Product::query()->where('company_id', $companyId)->inRandomOrder()->first();

        if ( ! $product) {
            /** @var Product $product */
            $product = Product::factory()->create(['company_id' => $companyId]);
        }

        return $product;
    }

    protected function findOrCreateFamily(int $companyId): Family
    {
        /** @var Family|null $family */
        $family = Family::query()->where('company_id', $companyId)->inRandomOrder()->first();

        if ( ! $family) {
            /** @var Family $family */
            $family = Family::factory()->create(['company_id' => $companyId]);
        }

        return $family;
    }

    protected function findOrCreateTaxRate(int $companyId): TaxRate
    {
        /** @var TaxRate|null $taxRate */
        $taxRate = TaxRate::query()->where('company_id', $companyId)->inRandomOrder()->first();

        if ( ! $taxRate) {
            /** @var TaxRate $taxRate */
            $taxRate = TaxRate::factory()->create(['company_id' => $companyId]);
        }

        return $taxRate;
    }

    protected function findOrCreateProject(int $companyId): Project
    {
        /** @var Project|null $project */
        $project = Project::query()->where('company_id', $companyId)->inRandomOrder()->first();

        if ( ! $project) {
            $client = $this->findOrCreateClient($companyId);

            /** @var Project $project */
            $project = Project::factory()->create([
                'company_id' => $companyId,
                'client_id'  => $client->client_id,
            ]);
        }

        return $project;
    }

    protected function findOrCreateTask(int $companyId): Task
    {
        /** @var Task|null $task */
        $task = Task::query()->where('company_id', $companyId)->inRandomOrder()->first();

        if ( ! $task) {
            $project = $this->findOrCreateProject($companyId);

            /** @var Task $task */
            $task = Task::factory()->create([
                'company_id' => $companyId,
                'project_id' => $project->project_id,
            ]);
        }

        return $task;
    }

    protected function findOrCreateUser(int $companyId): User
    {
        /** @var User|null $user */
        $user = User::query()
            ->whereHas('companies', fn ($q) => $q->where('companies.id', $companyId))
            ->inRandomOrder()
            ->first();

        if ( ! $user) {
            /** @var User $user */
            $user = User::factory()->create();
            $user->companies()->attach($companyId);
        }

        return $user;
    }

    private function seedWithProgress(): void
    {
        $bar = $this->command->getOutput()->createProgressBar($this->count);
        $bar->setFormat(" <comment>{$this->label}</comment> ▕%bar%▏ %current%/%max%");
        $bar->start();

        for ($i = 0; $i < $this->count; $i++) {
            $this->buildOne();
            $bar->advance();
        }

        $bar->finish();
        $this->command->newLine(2);
    }
}
