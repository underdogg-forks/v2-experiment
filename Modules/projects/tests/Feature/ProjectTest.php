<?php

namespace Modules\Projects\Tests\Feature;

use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Clients\Models\Client;
use Modules\Core\Models\Company;
use Modules\Core\Models\User;
use Modules\Projects\Filament\Resources\Projects\Pages\CreateProject;
use Modules\Projects\Filament\Resources\Projects\Pages\EditProject;
use Modules\Projects\Filament\Resources\Projects\Pages\ListProjects;
use Modules\Projects\Models\Project;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\AbstractCompanyPanelTestCase;

#[Group('projects')]
class ProjectTest extends AbstractCompanyPanelTestCase
{
    use RefreshDatabase;

    protected $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpClient();
    }

    #[Test]
    public function it_lists_projects(): void
    {
        Project::factory()->count(3)->create([
            'company_id' => $this->company->id,
            'client_id'  => $this->client->client_id,
        ]);

        Livewire::test(ListProjects::class, ['tenant' => $this->company])
            ->assertSuccessful();
    }

    #[Test]
    public function it_creates_a_project(): void
    {
        Livewire::test(CreateProject::class, ['tenant' => $this->company])
            ->set('data.project_name', 'Test Project')
            ->set('data.client_id', $this->client->client_id)
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('projects', [
            'project_name' => 'Test Project',
        ]);
    }

    #[Test]
    public function it_fails_to_create_project_without_required_fields(): void
    {
        Livewire::test(CreateProject::class, ['tenant' => $this->company])
            ->set('data.project_name', null)
            ->call('create')
            ->assertHasFormErrors([
                'project_name' => 'required',
            ]);
    }

    #[Test]
    public function it_edits_a_project(): void
    {
        $project = Project::factory()->create([
            'company_id' => $this->company->id,
            'client_id'  => $this->client->client_id,
        ]);

        Livewire::test(EditProject::class, ['record' => $project->project_id, 'tenant' => $this->company])
            ->set('data.project_name', 'Updated Project')
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('projects', [
            'project_id'   => $project->project_id,
            'project_name' => 'Updated Project',
        ]);
    }

    #[Test]
    public function it_deletes_a_project(): void
    {
        $project = Project::factory()->create([
            'company_id' => $this->company->id,
            'client_id'  => $this->client->client_id,
        ]);

        Livewire::test(EditProject::class, ['record' => $project->project_id, 'tenant' => $this->company])
            ->callAction(DeleteAction::class);

        $this->assertDatabaseMissing('projects', [
            'project_id' => $project->project_id,
        ]);
    }

    #[Test]
    public function it_only_lists_projects_for_the_current_tenant(): void
    {
        $otherCompany = Company::factory()->create();

        $ownProjects = Project::factory()->count(2)->create([
            'company_id' => $this->company->id,
            'client_id'  => $this->client->client_id,
        ]);

        Project::factory()->count(2)->create(['company_id' => $otherCompany->id]);

        Livewire::test(ListProjects::class, ['tenant' => $this->company])
            ->assertCanSeeTableRecords($ownProjects);
    }
}
