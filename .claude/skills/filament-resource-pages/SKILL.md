---
name: filament-resource-pages
description: "Implements Create, Edit, and List Filament resource pages. Activates when adding form logic, wiring a service class, setting default field values, handling record creation or updates, or when the user mentions CreateRecord, EditRecord, mutateFormData, handleRecordCreation, or handleRecordUpdate."
license: MIT
metadata:
  author: project
---

# Filament Resource Pages

## Critical: Instance Methods, Not Static

In Filament v5, `mutateFormData*` and `handleRecord*` are **instance methods on
the Page class**, not static methods on the Resource class. Defining them on the
Resource has no effect.

```php
// ✓ CORRECT — instance method on the Page class
class CreateInvoice extends CreateRecord
{
    protected function mutateFormDataBeforeCreate(array $data): array { ... }
    protected function handleRecordCreation(array $data): Model { ... }
}

// ✗ WRONG — static on Resource (does nothing in Filament v5)
class InvoiceResource extends Resource
{
    public static function mutateFormDataBeforeCreate(array $data): array { ... }
}
```

## mutateFormDataBeforeCreate

Use `??=` to set defaults for fields not in the form (NOT NULL columns, generated
values, system-assigned fields):

```php
protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['user_id']               ??= Filament::auth()->user()?->getKey();
    $data['invoice_date_created']  ??= now()->toDateString();
    $data['invoice_time_created']  ??= now()->toTimeString();
    $data['invoice_date_modified'] ??= now();
    $data['invoice_date_due']      ??= now()->addDays(30)->toDateString();
    $data['invoice_terms']         ??= '';
    $data['invoice_url_key']       ??= \Illuminate\Support\Str::random(32);
    $data['payment_method']        ??= 0;

    return $data;
}
```

## mutateFormDataBeforeSave

Same pattern for Edit pages. Guard nullable text fields that are NOT NULL in the DB:

```php
protected function mutateFormDataBeforeSave(array $data): array
{
    $data['invoice_terms'] ??= '';

    return $data;
}
```

## handleRecordCreation / handleRecordUpdate

Delegate to a Service class instead of letting Filament call `Model::create` directly:

```php
protected function handleRecordCreation(array $data): Model
{
    return app(InvoiceService::class)->createInvoice($data);
}

protected function handleRecordUpdate(Model $record, array $data): Model
{
    return app(InvoiceService::class)->updateInvoice($record, $data);
}
```

## Header Actions on Edit Pages

```php
protected function getHeaderActions(): array
{
    return [
        DeleteAction::make(),
    ];
}
```

## Common NOT NULL Traps

Models in this app have many NOT NULL columns with no DB default. Always check the
migration and guard these in `mutateFormDataBefore*`:

| Model    | Dangerous columns                                  |
|----------|----------------------------------------------------|
| Invoice  | user_id, invoice_terms, invoice_url_key, payment_method, invoice_time_created |
| Quote    | user_id, quote_url_key                             |
| Payment  | payment_note                                       |
| Product  | product_description                                |
