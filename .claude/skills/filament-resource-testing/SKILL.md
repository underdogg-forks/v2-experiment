---
name: filament-resource-testing
description: "Tests Filament resources using Livewire and PHPUnit. Activates when writing or fixing tests for Filament Create/Edit/List pages, testing multi-tenant resource isolation, or when the user mentions Livewire::test, actingAs, assertCanSeeTableRecords, assertHasFormErrors, or callAction."
license: MIT
metadata:
  author: project
---

# Filament Resource Testing

## Test Setup Boilerplate

Every Filament feature test needs the panel booted and a tenant set:

```php
protected function setUp(): void
{
    parent::setUp();

    Filament::setCurrentPanel(Filament::getPanel('company'));
    Filament::bootCurrentPanel();

    $this->company     = Company::factory()->create();
    Filament::setTenant($this->company, isQuiet: true);

    $this->invoiceGroup = InvoiceGroup::factory()->create(['company_id' => $this->company->id]);
    $this->client       = Client::factory()->create(['company_id' => $this->company->id]);
    $this->user         = User::factory()->create();
    $this->user->companies()->syncWithoutDetaching([$this->company->id]);
}
```

## List Page

```php
public function it_lists_invoices(): void
{
    $invoices = Invoice::factory()->count(3)->create([
        'company_id'       => $this->company->id,
        'client_id'        => $this->client->client_id,
        'invoice_group_id' => $this->invoiceGroup->invoice_group_id,
    ]);

    Livewire::actingAs($this->user)
        ->test(ListInvoices::class, ['tenant' => $this->company])
        ->assertSuccessful()
        ->assertCanSeeTableRecords($invoices);
}
```

## Create Page

Use `->set('data.field', value)` — **not** `->fillForm([])`:

```php
public function it_creates_an_invoice(): void
{
    Livewire::actingAs($this->user)
        ->test(CreateInvoice::class, ['tenant' => $this->company])
        ->set('data.client_id', $this->client->client_id)
        ->set('data.invoice_group_id', $this->invoiceGroup->invoice_group_id)
        ->set('data.invoice_date_created', now()->toDateString())
        ->set('data.invoice_date_due', now()->addDays(30)->toDateString())
        ->set('data.invoice_status_id', 1)
        ->set('data.invoice_discount_amount', 0)
        ->set('data.invoice_discount_percent', 0)
        ->set('data.is_read_only', false)
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('invoices', [
        'client_id'  => $this->client->client_id,
        'company_id' => $this->company->id,
    ]);
}
```

## Validation Failure

```php
public function it_fails_without_required_fields(): void
{
    Livewire::actingAs($this->user)
        ->test(CreateInvoice::class, ['tenant' => $this->company])
        ->set('data.client_id', null)
        ->call('create')
        ->assertHasFormErrors(['client_id' => 'required']);
}
```

## Edit Page

Pass `record` as the model's actual PK value (not `id`):

```php
public function it_edits_an_invoice(): void
{
    $invoice = Invoice::factory()->create([...]);

    Livewire::actingAs($this->user)
        ->test(EditInvoice::class, [
            'record' => $invoice->invoice_id,  // ← the custom PK
            'tenant' => $this->company,
        ])
        ->set('data.invoice_status_id', 2)
        ->call('save')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('invoices', ['invoice_id' => $invoice->invoice_id, 'invoice_status_id' => 2]);
}
```

## Delete Action

```php
public function it_deletes_an_invoice(): void
{
    $invoice = Invoice::factory()->create([...]);

    Livewire::actingAs($this->user)
        ->test(EditInvoice::class, ['record' => $invoice->invoice_id, 'tenant' => $this->company])
        ->callAction(DeleteAction::class)
        ->assertRedirect();

    $this->assertDatabaseMissing('invoices', ['invoice_id' => $invoice->invoice_id]);
}
```

## Multi-Tenancy Isolation

Switch the active tenant when creating records for a second company:

```php
public function it_only_lists_records_for_current_tenant(): void
{
    $companyA = $this->company;
    $companyB = Company::factory()->create();

    $recordA = Invoice::factory()->create(['company_id' => $companyA->id, ...]);

    Filament::setTenant($companyB, isQuiet: true);
    $recordB = Invoice::factory()->create(['company_id' => $companyB->id, ...]);
    Filament::setTenant($companyA, isQuiet: true);

    Livewire::actingAs($this->user)
        ->test(ListInvoices::class, ['tenant' => $companyA])
        ->assertCanSeeTableRecords([$recordA])
        ->assertCanNotSeeTableRecords([$recordB]);
}
```

## Imports Required in Test Files

```php
use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
```
