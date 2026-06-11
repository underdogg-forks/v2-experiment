<?php

namespace Modules\Payments\Tests\Feature;

use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Clients\Models\Client;
use Modules\Core\Models\Company;
use Modules\Core\Models\InvoiceGroup;
use Modules\Core\Models\User;
use Modules\Invoices\Models\Invoice;
use Modules\Payments\Filament\Resources\Payments\Pages\CreatePayment;
use Modules\Payments\Filament\Resources\Payments\Pages\EditPayment;
use Modules\Payments\Filament\Resources\Payments\Pages\ListPayments;
use Modules\Payments\Models\Payment;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group('payments')]
class PaymentTest extends TestCase
{
    use RefreshDatabase;

    protected $company;

    protected $user;

    protected $invoice;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel(Filament::getPanel('company'));
        Filament::bootCurrentPanel();

        $this->company = Company::factory()->create();
        Filament::setTenant($this->company, isQuiet: true);
        $this->user = User::factory()->create();
        $this->user->companies()->syncWithoutDetaching([$this->company->id]);

        $client       = Client::factory()->create(['company_id' => $this->company->id]);
        $invoiceGroup = InvoiceGroup::factory()->create(['company_id' => $this->company->id]);

        $this->invoice = Invoice::factory()->create([
            'company_id'       => $this->company->id,
            'client_id'        => $client->client_id,
            'invoice_group_id' => $invoiceGroup->invoice_group_id,
            'user_id'          => $this->user->user_id,
        ]);

        $this->actingAs($this->user);
    }

    #[Test]
    public function it_lists_payments(): void
    {
        /* Arrange */
        Payment::factory()->count(3)->create([
            'company_id' => $this->company->id,
            'invoice_id' => $this->invoice->invoice_id,
        ]);

        /* Act */
        $component = Livewire::test(ListPayments::class, ['tenant' => $this->company]);

        /* Assert */
        $component->assertSuccessful();
    }

    #[Test]
    public function it_creates_a_payment(): void
    {
        /* Arrange */

        /* Act */
        $component = Livewire::test(CreatePayment::class, ['tenant' => $this->company])
            ->set('data.invoice_id', $this->invoice->invoice_id)
            ->set('data.payment_amount', 250.00)
            ->set('data.payment_date', now()->toDateString())
            ->set('data.payment_method_id', 1)
            ->call('create');

        /* Assert */
        $component->assertHasNoFormErrors();

        $this->assertDatabaseHas('payments', [
            'invoice_id'     => $this->invoice->invoice_id,
            'payment_amount' => 250.00,
        ]);
    }

    #[Test]
    public function it_fails_to_create_payment_without_required_fields(): void
    {
        /* Arrange */

        /* Act */
        $component = Livewire::test(CreatePayment::class, ['tenant' => $this->company])
            ->set('data.invoice_id', null)
            ->set('data.payment_amount', null)
            ->set('data.payment_date', null)
            ->call('create');

        /* Assert */
        $component->assertHasFormErrors([
            'invoice_id'     => 'required',
            'payment_amount' => 'required',
            'payment_date'   => 'required',
        ]);
    }

    #[Test]
    public function it_edits_a_payment(): void
    {
        /* Arrange */
        $payment = Payment::factory()->create([
            'company_id' => $this->company->id,
            'invoice_id' => $this->invoice->invoice_id,
        ]);

        /* Act */
        $component = Livewire::test(EditPayment::class, ['record' => $payment->payment_id, 'tenant' => $this->company])
            ->set('data.payment_amount', 500.00)
            ->call('save');

        /* Assert */
        $component->assertHasNoFormErrors();

        $this->assertDatabaseHas('payments', [
            'payment_id'     => $payment->payment_id,
            'payment_amount' => 500.00,
        ]);
    }

    #[Test]
    public function it_deletes_a_payment(): void
    {
        /* Arrange */
        $payment = Payment::factory()->create([
            'company_id' => $this->company->id,
            'invoice_id' => $this->invoice->invoice_id,
        ]);

        /* Act */
        Livewire::test(EditPayment::class, ['record' => $payment->payment_id, 'tenant' => $this->company])
            ->callAction(DeleteAction::class);

        /* Assert */
        $this->assertDatabaseMissing('payments', [
            'payment_id' => $payment->payment_id,
        ]);
    }

    #[Test]
    public function it_only_lists_payments_for_the_current_tenant(): void
    {
        /* Arrange */
        $otherCompany = Company::factory()->create();

        $ownPayments = Payment::factory()->count(2)->create([
            'company_id' => $this->company->id,
            'invoice_id' => $this->invoice->invoice_id,
        ]);

        $otherInvoice = Invoice::factory()->create(['company_id' => $otherCompany->id]);
        Payment::factory()->count(2)->create([
            'company_id' => $otherCompany->id,
            'invoice_id' => $otherInvoice->invoice_id,
        ]);

        /* Act */
        $component = Livewire::test(ListPayments::class, ['tenant' => $this->company]);

        /* Assert */
        $component->assertCanSeeTableRecords($ownPayments);
    }
}
