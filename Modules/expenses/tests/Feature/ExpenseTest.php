<?php

namespace Modules\Expenses\Tests\Feature;

use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Core\Models\Company;
use Modules\Core\Models\User;
use Modules\Expenses\Filament\Resources\Expenses\Pages\CreateExpense;
use Modules\Expenses\Filament\Resources\Expenses\Pages\EditExpense;
use Modules\Expenses\Filament\Resources\Expenses\Pages\ListExpenses;
use Modules\Expenses\Models\Expense;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group('expenses')]
class ExpenseTest extends TestCase
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
    public function it_lists_expenses(): void
    {
        Expense::factory()->count(3)->create(['company_id' => $this->company->id]);

        Livewire::test(ListExpenses::class, ['tenant' => $this->company])
            ->assertSuccessful();
    }

    #[Test]
    public function it_creates_an_expense(): void
    {
        Livewire::test(CreateExpense::class, ['tenant' => $this->company])
            ->set('data.expense_number', 'EXP-0001')
            ->set('data.expense_status', 'draft')
            ->set('data.expense_type', 'internal')
            ->set('data.expensed_at', now()->toDateString())
            ->set('data.expense_amount', 100)
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('expenses', [
            'expense_number' => 'EXP-0001',
        ]);
    }

    #[Test]
    public function it_fails_to_create_expense_without_required_fields(): void
    {
        Livewire::test(CreateExpense::class, ['tenant' => $this->company])
            ->set('data.expense_number', null)
            ->set('data.expense_amount', null)
            ->call('create')
            ->assertHasFormErrors([
                'expense_number' => 'required',
                'expense_amount' => 'required',
            ]);
    }

    #[Test]
    public function it_edits_an_expense(): void
    {
        $expense = Expense::factory()->create(['company_id' => $this->company->id]);

        Livewire::test(EditExpense::class, ['record' => $expense->id, 'tenant' => $this->company])
            ->set('data.expense_number', 'EXP-9999')
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('expenses', [
            'id'             => $expense->id,
            'expense_number' => 'EXP-9999',
        ]);
    }

    #[Test]
    public function it_deletes_an_expense(): void
    {
        $expense = Expense::factory()->create(['company_id' => $this->company->id]);

        Livewire::test(EditExpense::class, ['record' => $expense->id, 'tenant' => $this->company])
            ->callAction(DeleteAction::class);

        $this->assertDatabaseMissing('expenses', [
            'id' => $expense->id,
        ]);
    }

    #[Test]
    public function it_only_lists_expenses_for_the_current_tenant(): void
    {
        $otherCompany = Company::factory()->create();

        $ownExpenses = Expense::factory()->count(2)->create(['company_id' => $this->company->id]);
        Expense::factory()->count(2)->create(['company_id' => $otherCompany->id]);

        Livewire::test(ListExpenses::class, ['tenant' => $this->company])
            ->assertCanSeeTableRecords($ownExpenses);
    }
}
