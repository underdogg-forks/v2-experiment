<?php

namespace Modules\Core\Tests\Feature;

use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Core\Filament\Resources\TaxRates\Pages\CreateTaxRate;
use Modules\Core\Filament\Resources\TaxRates\Pages\EditTaxRate;
use Modules\Core\Filament\Resources\TaxRates\Pages\ListTaxRates;
use Modules\Core\Models\Company;
use Modules\Core\Models\TaxRate;
use Modules\Core\Models\User;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TaxRateTest extends TestCase
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
    public function it_lists_tax_rates(): void
    {
        /* Arrange */
        TaxRate::factory(3)->create(['company_id' => $this->company->id]);

        /* Act */
        $component = Livewire::actingAs($this->user)
            ->test(ListTaxRates::class, ['tenant' => $this->company]);

        /* Assert */
        $component->assertSuccessful();
        $this->assertDatabaseCount('tax_rates', 3);
    }

    #[Test]
    #[Group('crud')]
    public function it_creates_a_tax_rate(): void
    {
        /* Arrange */
        $data = [
            'company_id'       => $this->company->id,
            'tax_rate_name'    => 'VAT 21%',
            'tax_rate_percent' => 21.0,
        ];

        /* Act */
        $component = Livewire::actingAs($this->user)
            ->test(CreateTaxRate::class, ['tenant' => $this->company])
            ->fillForm($data)
            ->call('create');

        /* Assert */
        $component->assertHasNoFormErrors();
        $this->assertDatabaseHas('tax_rates', ['tax_rate_name' => 'VAT 21%', 'tax_rate_percent' => 21.0]);
    }

    #[Test]
    #[Group('crud')]
    public function it_fails_to_create_tax_rate_without_required_fields(): void
    {
        /* Act */
        $component = Livewire::actingAs($this->user)
            ->test(CreateTaxRate::class, ['tenant' => $this->company])
            ->fillForm(['tax_rate_name' => null, 'tax_rate_percent' => null])
            ->call('create');

        /* Assert */
        $component->assertHasFormErrors(['tax_rate_name' => 'required', 'tax_rate_percent' => 'required']);
    }

    #[Test]
    #[Group('crud')]
    public function it_edits_a_tax_rate(): void
    {
        /* Arrange */
        $taxRate = TaxRate::factory()->create(['company_id' => $this->company->id, 'tax_rate_name' => 'Old Name']);

        /* Act */
        $component = Livewire::actingAs($this->user)
            ->test(EditTaxRate::class, ['record' => $taxRate->tax_rate_id, 'tenant' => $this->company])
            ->fillForm(['tax_rate_name' => 'New Name'])
            ->call('save');

        /* Assert */
        $component->assertHasNoFormErrors();
        $this->assertDatabaseHas('tax_rates', ['tax_rate_id' => $taxRate->tax_rate_id, 'tax_rate_name' => 'New Name']);
    }

    #[Test]
    #[Group('crud')]
    public function it_deletes_a_tax_rate(): void
    {
        /* Arrange */
        $taxRate = TaxRate::factory()->create(['company_id' => $this->company->id]);

        /* Act */
        Livewire::actingAs($this->user)
            ->test(EditTaxRate::class, ['record' => $taxRate->tax_rate_id, 'tenant' => $this->company])
            ->callAction('delete');

        /* Assert */
        $this->assertDatabaseMissing('tax_rates', ['tax_rate_id' => $taxRate->tax_rate_id]);
    }

    // endregion

    // region multi-tenancy

    #[Test]
    #[Group('multi-tenancy')]
    public function it_only_lists_tax_rates_for_the_current_tenant(): void
    {
        /* Arrange */
        $companyB = Company::factory()->create();
        TaxRate::factory()->create(['company_id' => $this->company->id, 'tax_rate_name' => 'VISIBLE']);
        TaxRate::factory()->create(['company_id' => $companyB->id, 'tax_rate_name' => 'HIDDEN']);

        /* Act */
        $component = Livewire::actingAs($this->user)
            ->test(ListTaxRates::class, ['tenant' => $this->company]);

        /* Assert */
        $component->assertSuccessful();
        $component->assertSeeText('VISIBLE');
        $component->assertDontSeeText('HIDDEN');
    }

    // endregion
}
