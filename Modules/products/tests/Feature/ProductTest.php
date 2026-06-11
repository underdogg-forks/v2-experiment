<?php

namespace Modules\Products\Tests\Feature;

use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Core\Models\Company;
use Modules\Core\Models\User;
use Modules\Products\Filament\Resources\Products\Pages\CreateProduct;
use Modules\Products\Filament\Resources\Products\Pages\EditProduct;
use Modules\Products\Filament\Resources\Products\Pages\ListProducts;
use Modules\Products\Models\Product;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group('products')]
class ProductTest extends TestCase
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
        $this->user->companies()->syncWithoutDetaching([$this->company->id]);

        $this->actingAs($this->user);
    }

    #[Test]
    public function it_lists_products(): void
    {
        Product::factory()->count(3)->create(['company_id' => $this->company->id]);

        Livewire::test(ListProducts::class, ['tenant' => $this->company])
            ->assertSuccessful();
    }

    #[Test]
    public function it_creates_a_product(): void
    {
        Livewire::test(CreateProduct::class, ['tenant' => $this->company])
            ->set('data.product_name', 'Test Product')
            ->set('data.product_price', 99.99)
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('products', [
            'product_name' => 'Test Product',
        ]);
    }

    #[Test]
    public function it_fails_to_create_product_without_required_fields(): void
    {
        Livewire::test(CreateProduct::class, ['tenant' => $this->company])
            ->set('data.product_name', null)
            ->set('data.product_price', null)
            ->call('create')
            ->assertHasFormErrors([
                'product_name'  => 'required',
                'product_price' => 'required',
            ]);
    }

    #[Test]
    public function it_edits_a_product(): void
    {
        $product = Product::factory()->create(['company_id' => $this->company->id]);

        Livewire::test(EditProduct::class, ['record' => $product->product_id, 'tenant' => $this->company])
            ->set('data.product_name', 'Updated Product')
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('products', [
            'product_id'   => $product->product_id,
            'product_name' => 'Updated Product',
        ]);
    }

    #[Test]
    public function it_deletes_a_product(): void
    {
        $product = Product::factory()->create(['company_id' => $this->company->id]);

        Livewire::test(EditProduct::class, ['record' => $product->product_id, 'tenant' => $this->company])
            ->callAction(DeleteAction::class);

        $this->assertDatabaseMissing('products', [
            'product_id' => $product->product_id,
        ]);
    }

    #[Test]
    public function it_only_lists_products_for_the_current_tenant(): void
    {
        $otherCompany = Company::factory()->create();

        $ownProducts = Product::factory()->count(2)->create(['company_id' => $this->company->id]);
        Product::factory()->count(2)->create(['company_id' => $otherCompany->id]);

        Livewire::test(ListProducts::class, ['tenant' => $this->company])
            ->assertCanSeeTableRecords($ownProducts);
    }
}
