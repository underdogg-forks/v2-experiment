<?php

namespace Modules\Quotes\Tests\Feature;

use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Clients\Models\Client;
use Modules\Core\Models\Company;
use Modules\Core\Models\InvoiceGroup;
use Modules\Core\Models\User;
use Modules\Quotes\Filament\Resources\Quotes\Pages\CreateQuote;
use Modules\Quotes\Filament\Resources\Quotes\Pages\EditQuote;
use Modules\Quotes\Filament\Resources\Quotes\Pages\ListQuotes;
use Modules\Quotes\Models\Quote;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group('quotes')]
class QuoteTest extends TestCase
{
    use RefreshDatabase;

    protected $company;

    protected $user;

    protected $client;

    protected $invoiceGroup;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel(Filament::getPanel('company'));
        Filament::bootCurrentPanel();

        $this->company      = Company::factory()->create();
        Filament::setTenant($this->company, isQuiet: true);
        $this->user         = User::factory()->create();
        $this->client       = Client::factory()->create(['company_id' => $this->company->id]);
        $this->invoiceGroup = InvoiceGroup::factory()->create(['company_id' => $this->company->id]);
        $this->user->companies()->syncWithoutDetaching([$this->company->id]);

        $this->actingAs($this->user);
    }

    #[Test]
    public function it_lists_quotes(): void
    {
        /* Arrange */
        Quote::factory()->count(3)->create([
            'company_id'       => $this->company->id,
            'client_id'        => $this->client->client_id,
            'invoice_group_id' => $this->invoiceGroup->invoice_group_id,
            'user_id'          => $this->user->user_id,
        ]);

        /* Act */
        $component = Livewire::test(ListQuotes::class, ['tenant' => $this->company]);

        /* Assert */
        $component->assertSuccessful();
    }

    #[Test]
    public function it_creates_a_quote(): void
    {
        /* Arrange */

        /* Act */
        $component = Livewire::test(CreateQuote::class, ['tenant' => $this->company])
            ->set('data.client_id', $this->client->client_id)
            ->set('data.invoice_group_id', $this->invoiceGroup->invoice_group_id)
            ->set('data.quote_date_expires', now()->addDays(30)->toDateString())
            ->set('data.quote_status_id', 1)
            ->call('create');

        /* Assert */
        $component->assertHasNoFormErrors();

        $this->assertDatabaseHas('quotes', [
            'client_id'  => $this->client->client_id,
            'company_id' => $this->company->id,
        ]);
    }

    #[Test]
    public function it_fails_to_create_quote_without_required_fields(): void
    {
        /* Arrange */

        /* Act */
        $component = Livewire::test(CreateQuote::class, ['tenant' => $this->company])
            ->set('data.client_id', null)
            ->call('create');

        /* Assert */
        $component->assertHasFormErrors([
            'client_id' => 'required',
        ]);
    }

    #[Test]
    public function it_edits_a_quote(): void
    {
        /* Arrange */
        $quote = Quote::factory()->create([
            'company_id'       => $this->company->id,
            'client_id'        => $this->client->client_id,
            'invoice_group_id' => $this->invoiceGroup->invoice_group_id,
            'user_id'          => $this->user->user_id,
        ]);

        /* Act */
        $component = Livewire::test(EditQuote::class, ['record' => $quote->quote_id, 'tenant' => $this->company])
            ->set('data.quote_number', 'QUO-9999')
            ->call('save');

        /* Assert */
        $component->assertHasNoFormErrors();

        $this->assertDatabaseHas('quotes', [
            'quote_id'     => $quote->quote_id,
            'quote_number' => 'QUO-9999',
        ]);
    }

    #[Test]
    public function it_deletes_a_quote(): void
    {
        /* Arrange */
        $quote = Quote::factory()->create([
            'company_id'       => $this->company->id,
            'client_id'        => $this->client->client_id,
            'invoice_group_id' => $this->invoiceGroup->invoice_group_id,
            'user_id'          => $this->user->user_id,
        ]);

        /* Act */
        Livewire::test(EditQuote::class, ['record' => $quote->quote_id, 'tenant' => $this->company])
            ->callAction(DeleteAction::class);

        /* Assert */
        $this->assertDatabaseMissing('quotes', [
            'quote_id' => $quote->quote_id,
        ]);
    }

    #[Test]
    public function it_only_lists_quotes_for_the_current_tenant(): void
    {
        /* Arrange */
        $otherCompany = Company::factory()->create();

        $ownQuotes = Quote::factory()->count(2)->create([
            'company_id'       => $this->company->id,
            'client_id'        => $this->client->client_id,
            'invoice_group_id' => $this->invoiceGroup->invoice_group_id,
            'user_id'          => $this->user->user_id,
        ]);

        Quote::factory()->count(2)->create(['company_id' => $otherCompany->id]);

        /* Act */
        $component = Livewire::test(ListQuotes::class, ['tenant' => $this->company]);

        /* Assert */
        $component->assertCanSeeTableRecords($ownQuotes);
    }
}
