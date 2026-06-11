<?php

namespace Modules\Core\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Core\Models\Company;
use Modules\Core\Models\TaxRate;
use Modules\Core\Services\TaxRateService;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TaxRateServiceTest extends TestCase
{
    use RefreshDatabase;

    private TaxRateService $service;

    private Company $company;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(TaxRateService::class);
        $this->company = Company::factory()->create();
    }

    #[Test]
    public function it_creates_a_tax_rate(): void
    {
        $taxRate = $this->service->createTaxRate([
            'company_id'       => $this->company->id,
            'tax_rate_name'    => 'VAT 21%',
            'tax_rate_percent' => 21.0,
        ]);

        $this->assertInstanceOf(TaxRate::class, $taxRate);
        $this->assertDatabaseHas('tax_rates', [
            'tax_rate_name'    => 'VAT 21%',
            'tax_rate_percent' => 21.0,
            'company_id'       => $this->company->id,
        ]);
    }

    #[Test]
    public function it_updates_a_tax_rate(): void
    {
        $taxRate = TaxRate::factory()->create([
            'company_id'       => $this->company->id,
            'tax_rate_name'    => 'Old Name',
            'tax_rate_percent' => 10.0,
        ]);

        $updated = $this->service->updateTaxRate($taxRate, [
            'tax_rate_name'    => 'New Name',
            'tax_rate_percent' => 15.0,
        ]);

        $this->assertEquals('New Name', $updated->tax_rate_name);
        $this->assertEquals(15.0, $updated->tax_rate_percent);
        $this->assertDatabaseHas('tax_rates', [
            'tax_rate_id'      => $taxRate->tax_rate_id,
            'tax_rate_name'    => 'New Name',
            'tax_rate_percent' => 15.0,
        ]);
    }

    #[Test]
    public function it_deletes_a_tax_rate(): void
    {
        $taxRate = TaxRate::factory()->create(['company_id' => $this->company->id]);

        $result = $this->service->deleteTaxRate($taxRate);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('tax_rates', ['tax_rate_id' => $taxRate->tax_rate_id]);
    }

    #[Test]
    public function it_lists_tax_rates_for_a_company(): void
    {
        $otherCompany = Company::factory()->create();

        TaxRate::factory()->create(['company_id' => $this->company->id, 'tax_rate_name' => 'AAA']);
        TaxRate::factory()->create(['company_id' => $this->company->id, 'tax_rate_name' => 'BBB']);
        TaxRate::factory()->create(['company_id' => $otherCompany->id, 'tax_rate_name' => 'CCC']);

        $results = $this->service->listForCompany($this->company->id);

        $this->assertCount(2, $results);
        $this->assertEquals('AAA', $results->first()->tax_rate_name);
        $this->assertFalse($results->contains('tax_rate_name', 'CCC'));
    }
}
