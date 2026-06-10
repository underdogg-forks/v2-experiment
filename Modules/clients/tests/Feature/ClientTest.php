<?php

namespace Modules\Clients\Tests\Feature;

use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Clients\Filament\Resources\Clients\Pages\CreateClient;
use Modules\Clients\Filament\Resources\Clients\Pages\EditClient;
use Modules\Clients\Filament\Resources\Clients\Pages\ListClients;
use Modules\Clients\Models\Client;
use Modules\Core\Models\Company;
use Modules\Core\Models\User;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    protected $company;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel(Filament::getPanel('company'));
        Filament::bootCurrentPanel();

        $this->company = Company::factory()->create();
        Filament::setTenant($this->company, isQuiet: true);
        $this->user = User::factory()->create();

        $this->user->companies()->attach($this->company->id);
    }

    #[Test]
    #[Group('crud')]
    public function it_lists_clients(): void
    {
        $clients = Client::factory()->count(3)->create(['company_id' => $this->company->id]);

        Livewire::actingAs($this->user)
            ->test(ListClients::class, ['tenant' => $this->company])
            ->assertSuccessful()
            ->assertCanSeeTableRecords($clients);

        $this->assertDatabaseCount('clients', 3);
    }

    #[Test]
    #[Group('crud')]
    public function it_creates_a_client(): void
    {
        Livewire::actingAs($this->user)
            ->test(CreateClient::class, ['tenant' => $this->company])
            ->fillForm([
                'client_name'    => 'Jane',
                'client_surname' => 'Doe',
                'client_email'   => 'jane@example.com',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('clients', [
            'client_name'    => 'Jane',
            'client_surname' => 'Doe',
            'client_email'   => 'jane@example.com',
            'company_id'     => $this->company->id,
        ]);
    }

    #[Test]
    #[Group('crud')]
    public function it_fails_to_create_client_without_required_fields(): void
    {
        Livewire::actingAs($this->user)
            ->test(CreateClient::class, ['tenant' => $this->company])
            ->fillForm([
                'client_name' => null,
            ])
            ->call('create')
            ->assertHasFormErrors(['client_name' => 'required']);
    }

    #[Test]
    #[Group('crud')]
    public function it_edits_a_client(): void
    {
        $client = Client::factory()->create(['company_id' => $this->company->id]);

        Livewire::actingAs($this->user)
            ->test(EditClient::class, ['record' => $client->client_id, 'tenant' => $this->company])
            ->fillForm([
                'client_name'    => 'Updated Name',
                'client_surname' => 'Updated Surname',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('clients', [
            'client_id'      => $client->client_id,
            'client_name'    => 'Updated Name',
            'client_surname' => 'Updated Surname',
        ]);
    }

    #[Test]
    #[Group('crud')]
    public function it_deletes_a_client(): void
    {
        $client = Client::factory()->create(['company_id' => $this->company->id]);

        Livewire::actingAs($this->user)
            ->test(EditClient::class, ['record' => $client->client_id, 'tenant' => $this->company])
            ->callAction(DeleteAction::class)
            ->assertRedirect();

        $this->assertDatabaseMissing('clients', [
            'client_id' => $client->client_id,
        ]);
    }

    #[Test]
    #[Group('crud')]
    public function it_filters_active_clients(): void
    {
        $activeClient   = Client::factory()->create(['company_id' => $this->company->id, 'client_active' => true]);
        $inactiveClient = Client::factory()->create(['company_id' => $this->company->id, 'client_active' => false]);

        Livewire::actingAs($this->user)
            ->test(ListClients::class, ['tenant' => $this->company])
            ->filterTable('client_active', true)
            ->assertCanSeeTableRecords([$activeClient])
            ->assertCanNotSeeTableRecords([$inactiveClient]);
    }

    #[Test]
    #[Group('multi-tenancy')]
    public function it_only_lists_clients_for_the_current_tenant(): void
    {
        $companyA = $this->company;
        $companyB = Company::factory()->create();

        $clientA = Client::factory()->create(['company_id' => $companyA->id]);
        $clientB = Client::factory()->create(['company_id' => $companyB->id]);

        Livewire::actingAs($this->user)
            ->test(ListClients::class, ['tenant' => $companyA])
            ->assertCanSeeTableRecords([$clientA])
            ->assertCanNotSeeTableRecords([$clientB]);
    }

    #[Test]
    #[Group('multi-tenancy')]
    public function it_only_returns_clients_belonging_to_the_current_tenant(): void
    {
        $companyA = $this->company;
        $companyB = Company::factory()->create();

        $clientA = Client::factory()->create(['company_id' => $companyA->id]);
        $clientB = Client::factory()->create(['company_id' => $companyB->id]);

        $results = Client::query()
            ->where('company_id', $companyA->id)
            ->get();

        $this->assertTrue($results->contains($clientA));
        $this->assertFalse($results->contains($clientB));
    }
}
