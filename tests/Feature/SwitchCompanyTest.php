<?php

namespace Tests\Feature;

use Filament\Actions\Testing\TestAction;
use Livewire\Livewire;
use Modules\Core\Models\Company;
use Modules\Core\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\AbstractCompanyPanelTestCase;

class SwitchCompanyTest extends AbstractCompanyPanelTestCase
{

    #[Test]
    public function it_can_switch_company(): void
    {
        /* Arrange */
        $user      = User::factory()->create(['user_rcc' => 'test']);
        $companies = Company::factory()->count(5)->sequence(fn ($seq) => ['search_code' => 'test' . $seq->index])->create();
        $user->companies()->attach($companies->pluck('id'));

        $this->actingAs($user);

        $initialCompany = $companies->first();
        session(['current_company_id' => $initialCompany->id]);

        /* Act */
        $test = Livewire::test(\App\Filament\Pages\SwitchCompany::class)
            ->callAction(TestAction::make('switch')->table($companies->last()));

        /* Assert */
        $test->assertRedirect(route('filament.company.home', ['tenant' => $companies->last()->search_code]));
        $this->assertEquals($companies->last()->id, session('current_company_id'));
    }

    #[Test]
    public function it_disables_switch_action_for_current_company(): void
    {
        /* Arrange */
        $user      = User::factory()->create(['user_rcc' => 'test']);
        $companies = Company::factory()->count(5)->sequence(fn ($seq) => ['search_code' => 'test' . $seq->index])->create();
        $user->companies()->attach($companies->pluck('id'));

        $this->actingAs($user);

        $initialCompany = $companies->first();
        session(['current_company_id' => $initialCompany->id]);

        /* Act & Assert */
        Livewire::test(\App\Filament\Pages\SwitchCompany::class)
            ->assertTableActionDisabled('switch', $companies->first())
            ->assertTableActionEnabled('switch', $companies->last());
    }
}
