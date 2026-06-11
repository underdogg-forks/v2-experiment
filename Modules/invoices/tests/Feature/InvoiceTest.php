<?php

namespace Modules\Invoices\Tests\Feature;

use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Clients\Models\Client;
use Modules\Core\Models\Company;
use Modules\Core\Models\InvoiceGroup;
use Modules\Core\Models\User;
use Modules\Invoices\Filament\Resources\Invoices\Pages\CreateInvoice;
use Modules\Invoices\Filament\Resources\Invoices\Pages\EditInvoice;
use Modules\Invoices\Filament\Resources\Invoices\Pages\ListInvoices;
use Modules\Invoices\Models\Invoice;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    protected $company;

    protected $client;

    protected $invoiceGroup;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel(Filament::getPanel('company'));
        Filament::bootCurrentPanel();

        $this->company = Company::factory()->create();
        Filament::setTenant($this->company, isQuiet: true);
        $this->client       = Client::factory()->create(['company_id' => $this->company->id]);
        $this->invoiceGroup = InvoiceGroup::factory()->create(['company_id' => $this->company->id]);
        $this->user         = User::factory()->create();

        $this->user->companies()->syncWithoutDetaching([$this->company->id]);
    }

    #[Test]
    #[Group('crud')]
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

    #[Test]
    #[Group('crud')]
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
            'client_id'         => $this->client->client_id,
            'invoice_group_id'  => $this->invoiceGroup->invoice_group_id,
            'invoice_status_id' => 1,
            'company_id'        => $this->company->id,
        ]);
    }

    #[Test]
    #[Group('crud')]
    public function it_fails_to_create_invoice_without_required_fields(): void
    {
        Livewire::actingAs($this->user)
            ->test(CreateInvoice::class, ['tenant' => $this->company])
            ->set('data.client_id', null)
            ->call('create')
            ->assertHasFormErrors(['client_id' => 'required']);
    }

    #[Test]
    #[Group('crud')]
    public function it_edits_an_invoice(): void
    {
        $invoice = Invoice::factory()->create([
            'company_id'       => $this->company->id,
            'client_id'        => $this->client->client_id,
            'invoice_group_id' => $this->invoiceGroup->invoice_group_id,
        ]);

        Livewire::actingAs($this->user)
            ->test(EditInvoice::class, ['record' => $invoice->invoice_id, 'tenant' => $this->company])
            ->set('data.invoice_status_id', 2)
            ->set('data.invoice_date_due', now()->addDays(60)->toDateString())
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('invoices', [
            'invoice_id'        => $invoice->invoice_id,
            'invoice_status_id' => 2,
        ]);
    }

    #[Test]
    #[Group('crud')]
    public function it_deletes_an_invoice(): void
    {
        $invoice = Invoice::factory()->create([
            'company_id'       => $this->company->id,
            'client_id'        => $this->client->client_id,
            'invoice_group_id' => $this->invoiceGroup->invoice_group_id,
        ]);

        Livewire::actingAs($this->user)
            ->test(EditInvoice::class, ['record' => $invoice->invoice_id, 'tenant' => $this->company])
            ->callAction(DeleteAction::class)
            ->assertRedirect();

        $this->assertDatabaseMissing('invoices', [
            'invoice_id' => $invoice->invoice_id,
        ]);
    }

    #[Test]
    #[Group('multi-tenancy')]
    public function it_only_lists_invoices_for_the_current_tenant(): void
    {
        $companyA = $this->company;
        $companyB = Company::factory()->create();

        Filament::setTenant($companyB, isQuiet: true);
        $clientB       = Client::factory()->create(['company_id' => $companyB->id]);
        $invoiceGroupB = InvoiceGroup::factory()->create(['company_id' => $companyB->id]);
        Filament::setTenant($companyA, isQuiet: true);

        $invoiceA = Invoice::factory()->create([
            'company_id'       => $companyA->id,
            'client_id'        => $this->client->client_id,
            'invoice_group_id' => $this->invoiceGroup->invoice_group_id,
        ]);

        Filament::setTenant($companyB, isQuiet: true);
        $invoiceB = Invoice::factory()->create([
            'company_id'       => $companyB->id,
            'client_id'        => $clientB->client_id,
            'invoice_group_id' => $invoiceGroupB->invoice_group_id,
        ]);
        Filament::setTenant($companyA, isQuiet: true);

        Livewire::actingAs($this->user)
            ->test(ListInvoices::class, ['tenant' => $companyA])
            ->assertCanSeeTableRecords([$invoiceA])
            ->assertCanNotSeeTableRecords([$invoiceB]);
    }
}
