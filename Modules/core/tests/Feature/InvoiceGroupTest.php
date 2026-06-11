<?php

namespace Modules\Core\Tests\Feature;

use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Core\Filament\Resources\InvoiceGroups\Pages\CreateInvoiceGroup;
use Modules\Core\Filament\Resources\InvoiceGroups\Pages\EditInvoiceGroup;
use Modules\Core\Filament\Resources\InvoiceGroups\Pages\ListInvoiceGroups;
use Modules\Core\Models\Company;
use Modules\Core\Models\InvoiceGroup;
use Modules\Core\Models\User;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class InvoiceGroupTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private Company $company;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel(Filament::getPanel('company'));
        Filament::bootCurrentPanel();

        $this->company = Company::factory()->create();
        Filament::setTenant($this->company, isQuiet: true);
        $this->user = User::factory()->create();
        $this->company->users()->syncWithoutDetaching([$this->user->user_id]);
    }

    // region crud

    #[Test]
    #[Group('crud')]
    public function it_lists_invoice_groups(): void
    {
        /* Arrange */
        InvoiceGroup::factory(3)->create(['company_id' => $this->company->id]);

        /* Act */
        $component = Livewire::actingAs($this->user)
            ->test(ListInvoiceGroups::class, ['tenant' => $this->company]);

        /* Assert */
        $component->assertSuccessful();
        $this->assertDatabaseCount('invoice_groups', 3);
    }

    #[Test]
    #[Group('crud')]
    public function it_creates_an_invoice_group(): void
    {
        /* Act */
        $component = Livewire::actingAs($this->user)
            ->test(CreateInvoiceGroup::class, ['tenant' => $this->company])
            ->set('data.invoice_group_name', 'Standard Invoices')
            ->set('data.invoice_group_identifier_format', '{YYYY}-{NUM}')
            ->set('data.invoice_group_next_id', 1)
            ->set('data.invoice_group_left_pad', 4)
            ->call('create');

        /* Assert */
        $component->assertHasNoFormErrors();
        $this->assertDatabaseHas('invoice_groups', ['invoice_group_name' => 'Standard Invoices']);
    }

    #[Test]
    #[Group('crud')]
    public function it_fails_to_create_invoice_group_without_required_fields(): void
    {
        /* Act */
        $component = Livewire::actingAs($this->user)
            ->test(CreateInvoiceGroup::class, ['tenant' => $this->company])
            ->set('data.invoice_group_name', null)
            ->set('data.invoice_group_identifier_format', null)
            ->set('data.invoice_group_next_id', null)
            ->set('data.invoice_group_left_pad', null)
            ->call('create');

        /* Assert */
        $component->assertHasFormErrors([
            'invoice_group_name'              => 'required',
            'invoice_group_identifier_format' => 'required',
            'invoice_group_next_id'           => 'required',
            'invoice_group_left_pad'          => 'required',
        ]);
    }

    #[Test]
    #[Group('crud')]
    public function it_edits_an_invoice_group(): void
    {
        /* Arrange */
        $invoiceGroup = InvoiceGroup::factory()->create([
            'company_id'         => $this->company->id,
            'invoice_group_name' => 'Old Group',
        ]);

        /* Act */
        $component = Livewire::actingAs($this->user)
            ->test(EditInvoiceGroup::class, ['record' => $invoiceGroup->invoice_group_id, 'tenant' => $this->company])
            ->set('data.invoice_group_name', 'New Group')
            ->call('save');

        /* Assert */
        $component->assertHasNoFormErrors();
        $this->assertDatabaseHas('invoice_groups', [
            'invoice_group_id'   => $invoiceGroup->invoice_group_id,
            'invoice_group_name' => 'New Group',
        ]);
    }

    #[Test]
    #[Group('crud')]
    public function it_deletes_an_invoice_group(): void
    {
        /* Arrange */
        $invoiceGroup = InvoiceGroup::factory()->create(['company_id' => $this->company->id]);

        /* Act */
        Livewire::actingAs($this->user)
            ->test(EditInvoiceGroup::class, ['record' => $invoiceGroup->invoice_group_id, 'tenant' => $this->company])
            ->callAction('delete');

        /* Assert */
        $this->assertDatabaseMissing('invoice_groups', ['invoice_group_id' => $invoiceGroup->invoice_group_id]);
    }

    // endregion

    // region multi-tenancy

    #[Test]
    #[Group('multi-tenancy')]
    public function it_only_lists_invoice_groups_for_the_current_tenant(): void
    {
        /* Arrange */
        $companyB = Company::factory()->create();
        InvoiceGroup::factory()->create(['company_id' => $this->company->id, 'invoice_group_name' => 'VISIBLE_GROUP']);
        Filament::setTenant($companyB, isQuiet: true);
        InvoiceGroup::factory()->create(['company_id' => $companyB->id, 'invoice_group_name' => 'HIDDEN_GROUP']);
        Filament::setTenant($this->company, isQuiet: true);

        /* Act */
        $component = Livewire::actingAs($this->user)
            ->test(ListInvoiceGroups::class, ['tenant' => $this->company]);

        /* Assert */
        $component->assertSuccessful();
        $component->assertSeeText('VISIBLE_GROUP');
        $component->assertDontSeeText('HIDDEN_GROUP');
    }

    // endregion
}
