<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SwitchCompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_switch_company()
    {
        // Setup user and companies
        $user      = User::factory()->create(['user_rcc' => 'test']);
        $companies = Company::factory()->count(5)->sequence(fn ($seq) => ['search_code' => 'test' . $seq->index])->create();
        $user->companies()->attach($companies->pluck('id'));

        $this->actingAs($user);

        // Set initial company
        $initialCompany = $companies->first();
        session(['current_company_id' => $initialCompany->id]);

        // We can test the Livewire component directly
        Livewire::test(\App\Livewire\SwitchCompany::class)
            ->callTableAction('switch', $companies->last())
            ->assertRedirect(route('filament.company.pages.dashboard', ['tenant' => $companies->last()->search_code]));

        $this->assertEquals($companies->last()->id, session('current_company_id'));
    }
}
