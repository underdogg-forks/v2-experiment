<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Clients\Models\Client;
use Modules\Clients\Models\ClientCustom;
use Modules\Expenses\Models\Expense;
use Modules\Expenses\Models\ExpenseCategory;
use Modules\Expenses\Models\ExpenseItem;
use Modules\Invoices\Models\Invoice;
use Modules\Invoices\Models\InvoiceAmount;
use Modules\Invoices\Models\InvoiceCustom;
use Modules\Invoices\Models\InvoiceItem;
use Modules\Invoices\Models\InvoiceItemAmount;
use Modules\Invoices\Models\InvoicesRecurring;
use Modules\Invoices\Models\InvoiceSumex;
use Modules\Invoices\Models\InvoiceTaxRate;
use Modules\Invoices\Models\ItemLookup;
use Modules\Payments\Models\MerchantResponse;
use Modules\Payments\Models\Payment;
use Modules\Payments\Models\PaymentCustom;
use Modules\Products\Models\Product;
use Modules\Products\Models\Unit;
use Modules\Projects\Models\Project;
use Modules\Projects\Models\Task;
use Modules\Quotes\Models\Quote;
use Modules\Quotes\Models\QuoteAmount;
use Modules\Quotes\Models\QuoteCustom;
use Modules\Quotes\Models\QuoteItem;
use Modules\Quotes\Models\QuoteItemAmount;
use Modules\Quotes\Models\QuoteTaxRate;

/**
 * @property int                            $id
 * @property string                         $search_code
 * @property string                         $name
 * @property string                         $slug
 * @property string|null                    $vat_number
 * @property string|null                    $id_number
 * @property string|null                    $coc_number
 * @property string|null                    $logo
 * @property string|null                    $quote_template
 * @property string|null                    $invoice_template
 * @property Collection|ClientCustom[]      $client_customs
 * @property Collection|Client[]            $clients
 * @property Collection|CustomField[]       $custom_fields
 * @property Collection|CustomValue[]       $custom_values
 * @property Collection|ExpenseCategory[]   $expense_categories
 * @property Collection|ExpenseItem[]       $expense_items
 * @property Collection|Expense[]           $expenses
 * @property Collection|InvoiceAmount[]     $invoice_amounts
 * @property Collection|InvoiceCustom[]     $invoice_customs
 * @property Collection|InvoiceGroup[]      $invoice_groups
 * @property Collection|InvoiceItemAmount[] $invoice_item_amounts
 * @property Collection|InvoiceItem[]       $invoice_items
 * @property Collection|InvoiceSumex[]      $invoice_sumexes
 * @property Collection|InvoiceTaxRate[]    $invoice_tax_rates
 * @property Collection|Invoice[]           $invoices
 * @property Collection|InvoicesRecurring[] $invoices_recurrings
 * @property Collection|ItemLookup[]        $item_lookups
 * @property Collection|MerchantResponse[]  $merchant_responses
 * @property Collection|PaymentCustom[]     $payment_customs
 * @property Collection|Payment[]           $payments
 * @property Collection|Product[]           $products
 * @property Collection|Project[]           $projects
 * @property Collection|QuoteAmount[]       $quote_amounts
 * @property Collection|QuoteCustom[]       $quote_customs
 * @property Collection|QuoteItemAmount[]   $quote_item_amounts
 * @property Collection|QuoteItem[]         $quote_items
 * @property Collection|QuoteTaxRate[]      $quote_tax_rates
 * @property Collection|Quote[]             $quotes
 * @property Collection|Setting[]           $settings
 * @property Collection|Task[]              $tasks
 * @property Collection|TaxRate[]           $tax_rates
 * @property Collection|Unit[]              $units
 * @property Collection|Upload[]            $uploads
 * @property Collection|UserClient[]        $user_clients
 * @property Collection|UserCustom[]        $user_customs
 */
class Company extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'companies';

    protected $guarded = [];

    public function client_customs(): HasMany
    {
        return $this->hasMany(ClientCustom::class);
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class, 'id', 'id');
    }

    public function custom_fields(): HasMany
    {
        return $this->hasMany(CustomField::class);
    }

    public function custom_values(): HasMany
    {
        return $this->hasMany(CustomValue::class);
    }

    public function expense_categories(): HasMany
    {
        return $this->hasMany(ExpenseCategory::class);
    }

    public function expense_items(): HasMany
    {
        return $this->hasMany(ExpenseItem::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function invoice_amounts(): HasMany
    {
        return $this->hasMany(InvoiceAmount::class);
    }

    public function invoice_customs(): HasMany
    {
        return $this->hasMany(InvoiceCustom::class);
    }

    public function invoice_groups(): HasMany
    {
        return $this->hasMany(InvoiceGroup::class);
    }

    public function invoice_item_amounts(): HasMany
    {
        return $this->hasMany(InvoiceItemAmount::class);
    }

    public function invoice_items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function invoice_sumexes(): HasMany
    {
        return $this->hasMany(InvoiceSumex::class);
    }

    public function invoice_tax_rates(): HasMany
    {
        return $this->hasMany(InvoiceTaxRate::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function invoices_recurrings(): HasMany
    {
        return $this->hasMany(InvoicesRecurring::class);
    }

    public function item_lookups(): HasMany
    {
        return $this->hasMany(ItemLookup::class);
    }

    public function merchant_responses(): HasMany
    {
        return $this->hasMany(MerchantResponse::class);
    }

    public function payment_customs(): HasMany
    {
        return $this->hasMany(PaymentCustom::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function quote_amounts(): HasMany
    {
        return $this->hasMany(QuoteAmount::class);
    }

    public function quote_customs(): HasMany
    {
        return $this->hasMany(QuoteCustom::class);
    }

    public function quote_item_amounts(): HasMany
    {
        return $this->hasMany(QuoteItemAmount::class);
    }

    public function quote_items(): HasMany
    {
        return $this->hasMany(QuoteItem::class);
    }

    public function quote_tax_rates(): HasMany
    {
        return $this->hasMany(QuoteTaxRate::class);
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }

    public function settings(): HasMany
    {
        return $this->hasMany(Setting::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function tax_rates(): HasMany
    {
        return $this->hasMany(TaxRate::class);
    }

    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }

    public function uploads(): HasMany
    {
        return $this->hasMany(Upload::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'company_user',
            'company_id',
            'user_id',
        )->using(CompanyUser::class);
    }

    public function user_clients(): HasMany
    {
        return $this->hasMany(UserClient::class);
    }

    public function user_customs(): HasMany
    {
        return $this->hasMany(UserCustom::class);
    }

    protected static function newFactory(): Factory
    {
        return \Modules\Core\Database\Factories\CompanyFactory::new();
    }
}
