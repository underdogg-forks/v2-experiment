<?php

namespace Modules\Core\Tests\Feature;

use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Core\Filament\Resources\EmailTemplates\Pages\CreateEmailTemplate;
use Modules\Core\Filament\Resources\EmailTemplates\Pages\EditEmailTemplate;
use Modules\Core\Filament\Resources\EmailTemplates\Pages\ListEmailTemplates;
use Modules\Core\Models\Company;
use Modules\Core\Models\EmailTemplate;
use Modules\Core\Models\User;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EmailTemplateTest extends TestCase
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
        $this->company->users()->attach($this->user->user_id);
    }

    // region crud

    #[Test]
    #[Group('crud')]
    public function it_lists_email_templates(): void
    {
        /* Arrange */
        EmailTemplate::factory(3)->create();

        /* Act */
        $component = Livewire::actingAs($this->user)
            ->test(ListEmailTemplates::class, ['tenant' => $this->company]);

        /* Assert */
        $component->assertSuccessful();
        $this->assertDatabaseCount('email_templates', 3);
    }

    #[Test]
    #[Group('crud')]
    public function it_creates_an_email_template(): void
    {
        /* Arrange */
        $data = [
            'email_template_title'      => 'Invoice Reminder',
            'email_template_type'       => 'invoice',
            'email_template_subject'    => 'Your invoice is ready',
            'email_template_from_name'  => 'Billing Team',
            'email_template_from_email' => 'billing@example.com',
            'email_template_body'       => 'Please find your invoice attached.',
        ];

        /* Act */
        $component = Livewire::actingAs($this->user)
            ->test(CreateEmailTemplate::class, ['tenant' => $this->company])
            ->fillForm($data)
            ->call('create');

        /* Assert */
        $component->assertHasNoFormErrors();
        $this->assertDatabaseHas('email_templates', [
            'email_template_title' => 'Invoice Reminder',
            'email_template_type'  => 'invoice',
        ]);
    }

    #[Test]
    #[Group('crud')]
    public function it_fails_to_create_email_template_without_required_fields(): void
    {
        /* Act */
        $component = Livewire::actingAs($this->user)
            ->test(CreateEmailTemplate::class, ['tenant' => $this->company])
            ->fillForm([
                'email_template_title' => null,
                'email_template_type'  => null,
                'email_template_body'  => null,
            ])
            ->call('create');

        /* Assert */
        $component->assertHasFormErrors([
            'email_template_title' => 'required',
            'email_template_type'  => 'required',
            'email_template_body'  => 'required',
        ]);
    }

    #[Test]
    #[Group('crud')]
    public function it_edits_an_email_template(): void
    {
        /* Arrange */
        $emailTemplate = EmailTemplate::factory()->create(['email_template_title' => 'Old Title']);

        /* Act */
        $component = Livewire::actingAs($this->user)
            ->test(EditEmailTemplate::class, ['record' => $emailTemplate->email_template_id, 'tenant' => $this->company])
            ->fillForm(['email_template_title' => 'New Title'])
            ->call('save');

        /* Assert */
        $component->assertHasNoFormErrors();
        $this->assertDatabaseHas('email_templates', [
            'email_template_id'    => $emailTemplate->email_template_id,
            'email_template_title' => 'New Title',
        ]);
    }

    #[Test]
    #[Group('crud')]
    public function it_deletes_an_email_template(): void
    {
        /* Arrange */
        $emailTemplate = EmailTemplate::factory()->create();

        /* Act */
        Livewire::actingAs($this->user)
            ->test(EditEmailTemplate::class, ['record' => $emailTemplate->email_template_id, 'tenant' => $this->company])
            ->callAction('delete');

        /* Assert */
        $this->assertDatabaseMissing('email_templates', ['email_template_id' => $emailTemplate->email_template_id]);
    }

    // endregion

    // region multi-tenancy

    #[Test]
    #[Group('multi-tenancy')]
    public function it_lists_all_email_templates_regardless_of_tenant(): void
    {
        /* Arrange */
        EmailTemplate::factory()->create(['email_template_title' => 'TEMPLATE_ONE']);
        EmailTemplate::factory()->create(['email_template_title' => 'TEMPLATE_TWO']);

        /* Act */
        $component = Livewire::actingAs($this->user)
            ->test(ListEmailTemplates::class, ['tenant' => $this->company]);

        /* Assert */
        $component->assertSuccessful();
        $component->assertSeeText('TEMPLATE_ONE');
        $component->assertSeeText('TEMPLATE_TWO');
    }

    // endregion
}
