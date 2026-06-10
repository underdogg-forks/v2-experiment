<?php

namespace Tests;

use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Core\Models\Company;
use Modules\Core\Models\User;
use Tests\TestCase;

abstract class AbstractCompanyPanelTestCase extends TestCase
{
    use DatabaseTransactions;

    protected $company;
    protected $client;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel(Filament::getPanel('company'));
        Filament::bootCurrentPanel();

        $this->company = Company::factory()->create();
        Filament::setTenant($this->company, isQuiet: true);
        $this->user = User::factory()->create();
        $this->user->companies()->syncWithoutDetaching([$this->company->id]);

        $this->actingAs($this->user);
    }

    protected function setUpClient(): void
    {
        $this->client = \Modules\Clients\Models\Client::factory()->create(['company_id' => $this->company->id]);
    }
}
