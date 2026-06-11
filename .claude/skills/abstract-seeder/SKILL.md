---
name: abstract-seeder
description: "Creates module seeders using the AbstractSeeder pattern. Activates when adding a new seeder, extending AbstractSeeder, using findOrCreate* helpers, or when the user mentions seeders, seeding data, AbstractSeeder, buildOne, or callWith."
license: MIT
metadata:
  author: project
---

# AbstractSeeder Pattern

## Location

`Modules\Core\Database\Seeders\AbstractSeeder`

All module seeders extend this class. Never extend Laravel's `Seeder` directly
for per-company data — use `AbstractSeeder`.

## Minimal Seeder

```php
namespace Modules\Clients\Database\Seeders;

use Modules\Clients\Models\Client;
use Modules\Core\Database\Seeders\AbstractSeeder;

class ClientsSeeder extends AbstractSeeder
{
    protected string $label = 'Clients';      // shown in progress bar
    protected int $defaultCount = 15;         // used when count not passed

    protected function buildOne(): void
    {
        Client::factory()->create(['company_id' => $this->companyId]);
    }
}
```

## With FK Dependencies

Use `findOrCreate*` helpers — they resolve dependencies lazily, only creating
records if none exist for the company:

```php
protected function buildOne(): void
{
    $client = $this->findOrCreateClient($this->companyId);
    $group  = $this->findOrCreateInvoiceGroup($this->companyId);
    $user   = $this->findOrCreateUser($this->companyId);

    Invoice::factory()->create([
        'company_id'       => $this->companyId,
        'client_id'        => $client->client_id,
        'invoice_group_id' => $group->invoice_group_id,
        'user_id'          => $user->user_id,
    ]);
}
```

## Available findOrCreate* Helpers

| Method | Returns | Creates via |
|--------|---------|-------------|
| `findOrCreateClient($companyId)` | `Client` | `Client::factory()` |
| `findOrCreateInvoiceGroup($companyId)` | `InvoiceGroup` | `InvoiceGroup::factory()` |
| `findOrCreateExpenseCategory($companyId)` | `ExpenseCategory` | `ExpenseCategory::factory()` |
| `findOrCreateInvoice($companyId)` | `Invoice` | `Invoice::factory()` + deps |
| `findOrCreateProduct($companyId)` | `Product` | `Product::factory()` |
| `findOrCreateFamily($companyId)` | `Family` | `Family::factory()` |
| `findOrCreateTaxRate($companyId)` | `TaxRate` | `TaxRate::factory()` |
| `findOrCreateProject($companyId)` | `Project` | `Project::factory()` + client |
| `findOrCreateTask($companyId)` | `Task` | `Task::factory()` + project |
| `findOrCreateUser($companyId)` | `User` | `User::factory()` + attach to company |

## State Hooks

```php
protected function beforeSeed(): void
{
    // runs once before the loop — use for counters/state resets
    $this->adminsRemaining = 2;
}

protected function afterSeed(): void
{
    // runs once after the loop — use for cleanup/summary
}
```

## Calling from DatabaseSeeder

```php
$this->callWith(InvoicesSeeder::class, [
    'company' => $company->id,
    'count'   => 25,
]);
```

The `run(int $company, int $count)` signature maps directly to these keys.
`company` is required — the seeder skips with a warning if it's missing.

## Available Properties Inside buildOne()

- `$this->companyId` — the current company's id
- `$this->count` — total records to seed (for conditional logic)
