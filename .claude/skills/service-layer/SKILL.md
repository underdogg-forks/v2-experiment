---
name: service-layer
description: "Implements Service classes for business logic. Activates when adding createX/updateX/deleteX methods, wiring a service into a Filament page, or when the user mentions Service class, InvoiceService, business logic, or handleRecordCreation."
license: MIT
metadata:
  author: project
---

# Service Layer

Every module has a single Service class that owns create/update/delete/list logic.
Filament page classes call services via `app(InvoiceService::class)->createInvoice($data)`.

## Convention

```
Modules/{Name}/src/Services/{Model}Service.php
namespace Modules\{Name}\Services;
```

## Standard Shape

```php
namespace Modules\Invoices\Services;

use Modules\Invoices\Models\Invoice;
use Illuminate\Database\Eloquent\Collection;

class InvoiceService
{
    public function createInvoice(array $data): Invoice
    {
        return Invoice::query()->create($data);
    }

    public function updateInvoice(Invoice $invoice, array $data): Invoice
    {
        $invoice->update($data);
        return $invoice->fresh();
    }

    public function deleteInvoice(Invoice $invoice): bool
    {
        return (bool) $invoice->delete();
    }

    public function listForCompany(int $companyId): Collection
    {
        return Invoice::query()->where('company_id', $companyId)->get();
    }

    public function findOrFail(int $invoiceId): Invoice
    {
        /** @var Invoice */
        return Invoice::query()->findOrFail($invoiceId);
    }
}
```

## Wiring into Filament Pages

```php
// CreateInvoice.php
protected function handleRecordCreation(array $data): Model
{
    return app(InvoiceService::class)->createInvoice($data);
}

// EditInvoice.php
protected function handleRecordUpdate(Model $record, array $data): Model
{
    return app(InvoiceService::class)->updateInvoice($record, $data);
}
```

## Rules

- No static methods — always instantiate via `app()` or constructor injection.
- No business logic in Page classes — move it to the Service.
- No Filament imports in Service classes — they must be framework-agnostic.
- `mutateFormDataBefore*` stays in the Page class (it's Filament infrastructure,
  not business logic).
- Services do not register themselves — no service provider binding needed for
  simple services resolved by `app()`.
